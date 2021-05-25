<?php

class StorePaymentApi {
	
	private static $gateway;
	
	protected function storeLogAction(StoreNavigation $request) {
		header('Access-Control-Allow-Origin: *', true); // allow cross domain requests

		$data = $request->getBodyAsJson();
		if( !$data || !is_object($data) || !isset($data->sig) ) {
			StoreModule::respondWithJson(array(
				"error" => array("code" => 1, "message" => "Bad request")
			));
		}

		$expectedHash = md5(StoreModule::$siteInfo->websiteUID);
		$hash = $this->publicDecrypt($data->sig);
		if( $hash !== $expectedHash ) {
			StoreModule::respondWithJson(array(
				"error" => array("code" => 2, "message" => "Bad signature")
			));
		}

		$list = StoreModuleOrder::findAll(array());
		foreach ($list as $idx => $li) {
			$list[$idx] = $li->jsonSerialize();
		}

		StoreModule::respondWithJson(array("ok" => true, "list" => $list));
	}

	protected function removeOrderAction(StoreNavigation $request) {
		header('Access-Control-Allow-Origin: *', true); // allow cross domain requests
		$data = $request->getBodyAsJson();
		if( !$data || !is_object($data) || !isset($data->id, $data->sig) ) {
			StoreModule::respondWithJson(array(
				"error" => array("code" => 1, "message" => "Bad request")
			));
		}

		$expectedHash = md5(StoreModule::$siteInfo->websiteUID . "|" . $data->id);
		$hash = $this->publicDecrypt($data->sig);
		if( $hash !== $expectedHash ) {
			StoreModule::respondWithJson(array(
				"error" => array("code" => 2, "message" => "Bad signature")
			));
		}

		$order = StoreModuleOrder::findById($data->id);
		if( $order && ($order->getState() == StoreModuleOrder::STATE_PENDING || $order->getState() == StoreModuleOrder::STATE_FAILED) )
			$order->delete();

		StoreModule::respondWithJson(array("ok" => true));
	}

	protected function storeSubmitAction(StoreNavigation $request) {
		$gatewayId = self::getGatewayIdFromRequest($request);
		$data = $request->getBodyAsJson();
		if (!$gatewayId || !is_object($data) || !$data
				|| !isset($data->formData) || !is_array($data->formData) || !$data->formData) exit();
		
		$transactionId = (isset($data->transactionId) && $data->transactionId) ? $data->transactionId : StoreData::randomHash(9, true);
//		$transactionId = mt_rand(1, mt_getrandmax());
		
		ob_start();
		$currency = StoreData::getCurrency();
		$priceOptions = StoreData::getPriceOptions();
		$cartData = StoreData::getCartData();
		$totals = (object) array(); StoreCartApi::calcTaxesAndShipping($totals, $cartData);
		$orderPrice = (isset($data->orderPrice) && $data->orderPrice) ? $data->orderPrice : $totals->totalPrice;
		$items = StoreCartApi::buildCartItemList($cartData, $priceOptions, $currency);
		$order = StoreModuleOrder::findByTransactionId($transactionId);
		if (!$order) $order = new StoreModuleOrder();
		$order->setTransactionId($transactionId)
				->setGatewayId($gatewayId)
				->setItems($items ? array_map('trim', $items) : array())
				->setPrice(floatval($orderPrice))
				->setBuyer(null)
				->setType('buy')
				->setState(StoreModuleOrder::STATE_PENDING)
				->setCurrency($currency)
				->setPriceOptions($priceOptions)
				->setBillingInfo($cartData->billingInfo)
				->setDeliveryInfo($cartData->deliveryInfo)
				->setOrderComment($cartData->orderComment)
				->setTaxAmount($totals->taxPrice)
				->setShippingAmount($totals->shippingPrice)
				->save();
		$response = array('createFields' => null, 'deleteFields' => array(), 'updateFields' => array(), 'error' => null);
		$formData = array(); $updateFields = array();
		foreach ($data->formData as $field) {
			if ($field->isPrice) {
				$field->value = $orderPrice;
				$fd = (isset($field->fixedDecimal) && is_numeric($field->fixedDecimal) && $field->fixedDecimal >= 0) ? $field->fixedDecimal : 2;
				$mlp = (isset($field->multiplier) && is_numeric($field->multiplier) && $field->multiplier > 0) ? $field->multiplier : 1;
				$field->value = number_format(($orderPrice * $mlp), $fd, '.', '');
				$updateFields[$field->name] = $field->value;
			} else if ($field->value == '{transactionId}') {
				$field->value = $transactionId;
				$updateFields[$field->name] = $field->value;
			}
			$formData[$field->name] = $field->value;
		}
		$response['updateFields'] = $updateFields;
		$gateway = self::getGateway($request);
		if ($gateway) {
			$response['createFields'] = $gateway->createFormFields($formData);
			$response['redirectUrl'] = $gateway->createRedirectUrl($formData);
			$response['noSubmit'] = ($response['createFields'] === false);
			$response['error'] = $gateway->getLastError();
		}
		ob_end_clean();
		StoreModule::respondWithJson($response);
		exit();
	}
	
	/**
	 * Verify function to verify payment from payment system
	 * @param StoreNavigation $request store request descriptor object.
	 */
	protected function storeVerifyAction(StoreNavigation $request) {
		$gateway = self::getGateway($request);
		file_put_contents(dirname(__FILE__).'/store_orders_verify.log', print_r(array(
			'time' => date('Y-m-d H:i:s'),
			'gateway' => self::getGatewayIdFromRequest($request),
			'POST' => $request->getFormParams(),
			'GET' => $request->getQueryParams()
		), true)."\n\n", FILE_APPEND);
		if ($gateway) {
			$order = ($txnId = $gateway->getTransactionId()) ? StoreModuleOrder::findByTransactionId($txnId) : null;
			$gateway->verify($order);
		}
		exit();
	}
	
	/**
	 * Callback function to complete payment from payment system
	 * @param StoreNavigation $request store request descriptor object.
	 */
	protected function storeCallbackAction(StoreNavigation $request) {
		$gateway = self::getGateway($request);
		file_put_contents(dirname(__FILE__).'/store_orders.log', print_r(array(
			'time' => date('Y-m-d H:i:s'),
			'gateway' => self::getGatewayIdFromRequest($request),
			'gatewayOK' => ($gateway ? 'Yes' : 'No'),
			'gatewayTransactionId' => ($gateway ? $gateway->getTransactionId() : null),
			'POST' => $request->getFormParams(),
			'GET' => $request->getQueryParams()
		), true)."\n\n", FILE_APPEND);
		
		if ($gateway) {
			$clbRes = $gateway->callback(StoreModuleOrder::findByTransactionId($gateway->getTransactionId()));
			if (is_null($clbRes))
				throw new ErrorException('Error: Gateway callback method must return boolean value.');
			if ($clbRes && ($order = StoreModuleOrder::findByTransactionId($gateway->getTransactionId()))) {
				$buyerData = $gateway->getClientInfo();
				if ($buyerData) $order->setBuyer(StoreModuleBuyer::create()->setData($buyerData));
				$order->setCompleteDateTime(date('Y-m-d H:i:s'))
						->setState(StoreModuleOrder::STATE_COMPLETE)
						->save();
				if (isset(StoreModule::$initData->contactFormId) && StoreModule::$initData->contactFormId) {
					foreach (StoreModule::$siteInfo->forms as $pageForms) {
						foreach ($pageForms as $formId => $form) {
							if ($formId == StoreModule::$initData->contactFormId) {
								$subject = "Order #{$order->getTransactionId()} at ".StoreModule::$siteInfo->domain;
								self::sendMail($subject, self::prepareMailBody($order), $form, $request);
								break 2;
							}
						}
					}
				}
			}
		}
		if ($gateway && $gateway->doReturnAfterCallback()) {
			$this->storeReturnAction($request);
		}
		exit();
	}
	
	protected function storeReturnAction(StoreNavigation $request) {
		$gateway = self::getGateway($request);
		if ($gateway) $gateway->completeCheckout();
		if (session_id()) { $_SESSION['store_return'] = true; }
		$backUrl = $request->getFormParam('store_return_backUrl', $request->getQueryParam('store_return_backUrl', $request->getUri()));
		StoreNavigation::redirect($backUrl);
		exit();
	}
	
	protected function storeCancelAction(StoreNavigation $request) {
		$gateway = self::getGateway($request);
		if ($gateway) $gateway->cancel();
		if (session_id()) {
			$_SESSION['store_cancel'] = true;
			$_SESSION['store_cancel_exText'] = $request->getFormParam('exText', $request->getQueryParam('exText'));
		}
		$backUrl = $request->getFormParam('store_cancel_backUrl', $request->getQueryParam('store_cancel_backUrl', $request->getUri()));
		StoreNavigation::redirect($backUrl);
		exit();
	}
	
	private static function gatewayBackMessage($type, $exText = null) {
		if ($type == 'return') {
			StoreCartApi::clearStoreCart();
			$alert = 'success';
			$text = StoreModule::__('Payment has been submitted');
		} else if ($type == 'cancel') {
			$alert = 'danger';
			$text = StoreModule::__('Payment has been canceled');
		}
		if (session_id()) { $sessKey = 'store_'.$type; $_SESSION[$sessKey] = null; unset($_SESSION[$sessKey]); }
		$out = "<script type=\"text/javascript\">".
			"$('<div>')".
				".addClass('alert alert-{$alert}')".
				".css({"
					."position: 'fixed', "
					."right: '10px', "
					."top: '10px', "
					."zIndex: 10000, "
					."fontSize: '24px', "
					."padding: '30px 50px', "
					."lineHeight: '24px', "
					."maxWidth: '748px'"
				."})".
				".append('{$text}')".
				($exText ? ".append('<br />').append($('<span>').css({"
					."fontSize: '14px', "
					."lineHeight: '18px'"
				."}).append('".addslashes($exText)."'))" : "").
				".prepend($('<button>')".
					".addClass('close')".
					".css({marginRight: '-40px', marginTop: '-24px'})".
					".html(\"&nbsp;&times;\")".
					".on('click', function() {".
						"$(this).parent().remove();".
					"})".
				")".
				".appendTo('body');".
			"</script>";
		return $out;
	}
	
	private static function getGatewayIdFromRequest(StoreNavigation $request) {
		$gatewayId = $request->getQueryParam('gatewayId');
		if (!$gatewayId) $gatewayId = $request->getArg(1);
		return $gatewayId;
	}
	
	/**
	 * Get currently used gateway instance
	 * @param StoreNavigation $request store request descriptor object.
	 * @return PaymentGateway|null
	 */
	private static function getGateway(StoreNavigation $request) {
		if (!self::$gateway) {
			$gatewayId = self::getGatewayIdFromRequest($request);
			if ($gatewayId) {
				$cls = 'Gateway'.implode('', array_map('ucfirst', preg_split('#(?:_|\-|(\d))#', $gatewayId, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE)));
				$file = dirname(__FILE__).'/'.$cls.'.php';
				$dfile = dirname(__FILE__).'/PaymentGateway.php';
				if (!is_file($file)) {
					$file = dirname(__FILE__).'/../../'.$cls.'.php';
				}
				if (is_file($file) && is_file($dfile)) {
					$config = isset(StoreModule::$initData->gatewayConfig[$gatewayId]) ? StoreModule::$initData->gatewayConfig[$gatewayId] : null;
					if (!$config || !is_object($config)) $config = new stdClass();
					
					// Note: backwards compatibility, since usage of globals was part of public API.
					if (isset($config->gatewayId) && $config->gatewayId) {
						foreach ($config as $k => $v) {
							$vname = 'store_'.$config->gatewayId.'_'.$k;
							global $$vname;
							$$vname = $v;
						}
					}
					
					$config->wbBaseLang = $request->baseLang;
					$config->wbDefLang = $request->defLang;
					$config->wbLang = $request->lang;
					require_once($dfile);
					require_once($file);
					self::$gateway = new $cls($config);
				}
			}
		}
		return self::$gateway;
	}
	
	/**
	 * Format price according to price options
	 * @param float $price
	 * @return string
	 */
	private static function getFormattedPrice($price) {
		$currency = StoreData::getCurrency();
		$priceOpts = StoreData::getPriceOptions();
		$point = $priceOpts->decimalPoint ? $priceOpts->decimalPoint : '.';
		$places = $priceOpts->decimalPlaces ? $priceOpts->decimalPlaces : 2;
		$prefix = $currency ? $currency->prefix : '';
		$postfix = $currency ? ($currency->postfix ? $currency->postfix : (($currency->code && !$prefix) ? ' '.$currency->code : '')) : '';
		return $prefix . number_format(floatval($price), $places, $point, '') . $postfix;
	}
	
	/**
	 * Generate email body
	 * @param StoreModuleOrder $order
	 * @return string
	 */
	private static function prepareMailBody(StoreModuleOrder $order) {
		$style = "* { font: 12px Arial; line-height: 20px; }\nstrong { font-weight: bold; }";
		$rows = array();
		if ($order->getCompleteDateTime()) {
			$rows[] = '<tr>'.
					'<td><strong>'.StoreModule::__('Time').':</strong>&nbsp;</td>'.
					'<td>'.$order->getCompleteDateTime().'</td>'.
				'</tr>';
		}
		if ($order->getGatewayId()) {
			$rows[] = '<tr>'.
					'<td><strong>'.StoreModule::__('Payment Gateway').':</strong>&nbsp;</td>'.
					'<td>'.$order->getGatewayId().'</td>'.
				'</tr>';
		}
		if (!empty($rows)) {
			$rows[] = '<tr><td>&nbsp;</td></tr>';
		}
		if ($order->getBuyer() && $order->getBuyer()->getData()) {
			self::buildInfoHtmlTableRows(StoreModule::__('Payer (from gateway)'), $order->getBuyer()->getData(), $rows);
		}
		if ($order->getBillingInfo()) {
			self::buildInfoHtmlTableRows(StoreModule::__('Billing Information'), $order->getBillingInfo()->jsonSerialize(), $rows);
		}
		if ($order->getDeliveryInfo()) {
			self::buildInfoHtmlTableRows(StoreModule::__('Delivery Information'), $order->getDeliveryInfo()->jsonSerialize(), $rows);
		}
		if ($order->getOrderComment()) {
			self::buildInfoHtmlTableRows(StoreModule::__('Order Comments'), $order->getOrderComment(), $rows);
		}
		if ($order->getItems()) {
			$rows[] = '<tr><td colspan="2"><strong>'.StoreModule::__('Purchase details').':</strong></td></tr>';
			foreach ($order->getItems() as $item) {
				$rows[] = '<tr><td colspan="2">'.$item.'</td></tr>';
			}
			$rows[] = '<tr><td>&nbsp;</td></tr>';
		}
		if ($order->getShippingAmount()) {
			$rows[] = '<tr>'.
					'<td><strong>'.StoreModule::__('Shipping amount').':</strong></td>'.
					'<td><strong>'.self::getFormattedPrice($order->getShippingAmount()).'</strong></td>'.
				'</tr>';
		}
		if ($order->getTaxAmount()) {
			$rows[] = '<tr>'.
					'<td><strong>'.StoreModule::__('Tax amount').':</strong></td>'.
					'<td><strong>'.self::getFormattedPrice($order->getTaxAmount()).'</strong></td>'.
				'</tr>';
		}
		if ($order->getPrice()) {
			$rows[] = '<tr>'.
					'<td><strong>'.StoreModule::__('Total').':</strong></td>'.
					'<td><strong>'.self::getFormattedPrice($order->getPrice()).'</strong></td>'.
				'</tr>';
		}
		$message = '<table cellspacing="5" cellpadding="0">'.implode("\n", $rows).'</table>';
		
		$html =
'<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv=Content-Type content="text/html; charset=utf-8">
		' . ($style?"<style><!--\n$style\n--></style>\n\t\t":"") . '</head>
	<body>' . $message . '</body>
</html>';
		
		return $html;
	}
	
	private static function buildInfoHtmlTableRows($title, $info, &$rows) {
		$hasAny = false;
		if ($info && (is_array($info) || is_object($info))) {
			foreach ($info as $k => $v) {
				if (!$v) continue;
				if (!$hasAny) {
					$rows[] = '<tr><td colspan="2"><strong>'.$title.':</strong></td></tr>';
					$hasAny = true;
				}
				$rows[] = '<tr>'.
						'<td><strong>'.(function_exists('mb_ucfirst') ? mb_ucfirst($k) : ucfirst($k)).':</strong>&nbsp;</td>'.
						'<td>'.$v.'</td>'.
					'</tr>';
			}
		} else if (is_string($info)) {
			$hasAny = true;
			$rows[] = '<tr><td colspan="2"><strong>'.$title.':</strong></td></tr>';
			$rows[] = '<tr><td colspan="2">'.$info.'</td></tr>';
		}
		if ($hasAny) $rows[] = '<tr><td colspan="2">&nbsp;</td></tr>';
	}
	
	/**
	 * Send email to site owner
	 * @param string $subject
	 * @param string $body
	 * @param array $options
	 */
	private static function sendMail($subject, $body, $options, StoreNavigation $request) {
		if (!class_exists('PHPMailer')) {
			include $request->basePath.'/phpmailer/class.phpmailer.php';
		}
		$mailer = new PHPMailer();
		if (isset($options['smtpEnable']) && $options['smtpEnable']) {
			include $request->basePath.'/phpmailer/class.smtp.php';
			
			$mailer->isSMTP();
			$mailer->Host = ((isset($options['smtpHost']) && $options['smtpHost']) ? $options['smtpHost'] : 'localhost');
			$mailer->Port = ((isset($options['smtpPort']) && intval($options['smtpPort'])) ? intval($options['smtpPort']) : 25);
			$mailer->SMTPSecure = ((isset($options['smtpEncryption']) && $options['smtpEncryption']) ? $options['smtpEncryption'] : '');
			$mailer->SMTPAutoTLS = false;
			if (isset($options['smtpUsername']) && $options['smtpUsername'] && isset($options['smtpPassword']) && $options['smtpPassword']) {
				$mailer->SMTPAuth = true;
				$mailer->Username = ((isset($options['smtpUsername']) && $options['smtpUsername']) ? $options['smtpUsername'] : '');
				$mailer->Password = ((isset($options['smtpPassword']) && $options['smtpPassword']) ? $options['smtpPassword'] : '');
			}
			$mailer->SMTPOptions = array('ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			));
		}
		$optsObject = json_decode($options['object'], true);
		$sender_name = $optsObject['sender_name'];
		$sender_email = (isset($options['emailFrom']) && $options['emailFrom']) ? $options['emailFrom'] : $optsObject['sender_email'];
		$mailer->SetFrom($sender_email, $sender_name);
		$mailer->AddAddress($options['email']);
		$mailer->CharSet = 'utf-8';
		$mailer->msgHTML($body);
		$mailer->AltBody = strip_tags(str_replace("</tr>", "</tr>\n", $body));
		$mailer->Subject = $subject ? $subject : $options['subject'];
		$mailer->Send();
	}
	
	public static function process(StoreNavigation $request, $homePage = false) {
		if ($homePage) {
			$ctrl = new self();
			$key = $request->getArg(0);
			$cartAction = array_map('ucfirst', explode('-', strtolower(preg_replace('#[^a-zA-Z0-9\-]+#', '', $key))));
			$cartAction[0] = strtolower($cartAction[0]);
			$method = implode('', $cartAction).'Action';
			if (method_exists($ctrl, $method)) {
				call_user_func(array($ctrl, $method), $request);
			} else if ($request) {
				$gateway = self::getGateway($request);
				if ($gateway && method_exists($gateway, $key)) {
					StoreModule::respondWithJson(call_user_func(array($gateway, $key)));
				}
			}
		}
		if (session_id() && isset($_SESSION['store_return'])) {
			return self::gatewayBackMessage('return');
		}
		if (session_id() && isset($_SESSION['store_cancel'])) {
			$exText = (isset($_SESSION['store_cancel_exText']) && $_SESSION['store_cancel_exText'])
					? $_SESSION['store_cancel_exText'] : null;
			$_SESSION['store_cancel_exText'] = null;
			unset($_SESSION['store_cancel_exText']);
			return self::gatewayBackMessage('cancel', $exText);
		}
		return null;
	}

	/**
	 * @param string $publicKey
	 * @param string $token
	 * @return TokenVerifyTokenData|null
	 */
	private function decryptToken($publicKey, $token) {
		$data = '';
		$dataParts = str_split(base64_decode($token), 256);
		foreach ($dataParts as $part) {
			$dPart = '';
			if ($this->opensslPublicDecryptPure($part, $dPart, $publicKey) === false) {
				return null;
			}
			$data .= $dPart;
		}
		return TokenVerifyTokenData::fromJson($data);
	}

	private function publicDecrypt($encData) {
		require_once __DIR__.'/../../phpseclib/Crypt/Random.php';
		require_once __DIR__.'/../../phpseclib/Math/BigInteger.php';
		require_once __DIR__.'/../../phpseclib/Crypt/Hash.php';
		require_once __DIR__.'/../../phpseclib/Crypt/RSA.php';
		$rsa = new \phpseclib\Crypt\RSA();
		$rsa->loadKey($this->getSecurityPublicKey());
		$rsa->setEncryptionMode(\phpseclib\Crypt\RSA::ENCRYPTION_PKCS1);
		$data = @$rsa->decrypt(base64_decode($encData));
		return ($data === false) ? null : $data;
	}

	private function publicEncrypt($data) {
		require_once __DIR__.'/../../phpseclib/Crypt/Random.php';
		require_once __DIR__.'/../../phpseclib/Math/BigInteger.php';
		require_once __DIR__.'/../../phpseclib/Crypt/Hash.php';
		require_once __DIR__.'/../../phpseclib/Crypt/RSA.php';
		$rsa = new \phpseclib\Crypt\RSA();
		$rsa->loadKey($this->getSecurityPublicKey());
		$rsa->setEncryptionMode(\phpseclib\Crypt\RSA::ENCRYPTION_PKCS1);
		$encData = @$rsa->encrypt($data);
		return ($encData === false) ? null : base64_encode($encData);
	}

	private function getSecurityPublicKey() {
		return "-----BEGIN PUBLIC KEY-----\n"
		."MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzeio9jpU3e31Rlc4w0SA\n"
		."jOWOkjS++yZnyaziUDyLXupLxELER2SHyA2nFG7eOuKPohYFomX/GQdtbMLLL+4J\n"
		."/IofyOi1t/jlafY3wzTYCN2u8pfYP6L5sChuE3zb+g7Gvq/1XewiroDChy0mE+zr\n"
		."mATJp+UY2zcc60S0aiv+mFaGHrD6vyK/uUlfd2XbLNjWJnOe4HKq/uZb9MK8yY34\n"
		."snpLzrwmnxjS0/UDvljdrUAA1gIYA8rIO08AiyT9evTQEMyp4861COfGVdASHi/i\n"
		."O5piPRMp1BuY0LYk0ykA79gI7kygk5qQRcHJLZ1jhsm4jHl7chrjJ3jis8Pk4ico\n"
		."KwIDAQAB\n"
		."-----END PUBLIC KEY-----\n";
	}

}
