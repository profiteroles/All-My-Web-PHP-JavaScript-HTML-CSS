<?php
	error_reporting(E_ALL); @ini_set('display_errors', true);
	@session_start();
	$tz = @date_default_timezone_get(); @date_default_timezone_set($tz ? $tz : 'UTC');
	require_once dirname(__FILE__).'/polyfill.php';
	$pages = array(
		'0'	=> array('id' => '1', 'alias' => '', 'file' => '1.php','controllers' => array()),
		'1'	=> array('id' => '2', 'alias' => 'ABOUT', 'file' => '2.php','controllers' => array()),
		'2'	=> array('id' => '8', 'alias' => 'FBPP', 'file' => '8.php','controllers' => array()),
		'3'	=> array('id' => '17', 'alias' => 'Payment', 'file' => '17.php','controllers' => array()),
		'4'	=> array('id' => '11', 'alias' => 'Privacy', 'file' => '11.php','controllers' => array()),
		'5'	=> array('id' => '12', 'alias' => 'Terms', 'file' => '12.php','controllers' => array()),
		'6'	=> array('id' => '16', 'alias' => 'Refund', 'file' => '16.php','controllers' => array()),
		'7'	=> array('id' => '14', 'alias' => 'Erol', 'file' => '14.php','controllers' => array()),
		'8'	=> array('id' => '9', 'alias' => 'Sharon', 'file' => '9.php','controllers' => array()),
		'9'	=> array('id' => '4', 'alias' => 'CLASSES', 'file' => '4.php','controllers' => array()),
		'10'	=> array('id' => '13', 'alias' => 'COACHING', 'file' => '13.php','controllers' => array()),
		'11'	=> array('id' => '15', 'alias' => 'Online', 'file' => '15.php','controllers' => array()),
		'12'	=> array('id' => '5', 'alias' => 'PRICING', 'file' => '5.php','controllers' => array()),
		'13'	=> array('id' => '6', 'alias' => 'EVENTS', 'file' => '6.php','controllers' => array()),
		'14'	=> array('id' => '19', 'alias' => 'Workshops', 'file' => '19.php','controllers' => array()),
		'15'	=> array('id' => '10', 'alias' => 'SHOP', 'file' => '10.php','controllers' => array()),
		'16'	=> array('id' => '3', 'alias' => 'CONTACT', 'file' => '3.php','controllers' => array()),
		'17'	=> array('id' => '7', 'alias' => 'FAQ', 'file' => '7.php','controllers' => array())
	);
	$forms = array(
		'3'	=> array(
			'53e08674' => Array( 'email' => 'noreply@uniqmoves.com', 'emailFrom' => 'my@uniqmoves.com', 'subject' => 'Enquire from the contact page', 'sentMessage' => unserialize('s:54:"Ta da! Please Check Your Inbox For Confirmation E-mail";'), 'object' => '', 'objectRenderer' => '', 'loggingHandler' => '', 'smtpEnable' => true, 'smtpHost' => 'smtp.hostinger.com', 'smtpPort' => 587, 'smtpEncryption' => 'tls', 'smtpUsername' => 'my@uniqmoves.com', 'smtpPassword' => 'Ability440744.', 'recSiteKey' => '6LdrhdcUAAAAAETXUiVIs6WsU-q7XYHTMoifEogO', 'recSecretKey' => '6LdrhdcUAAAAAIxbL7Za0S1OoYBVqkQ88oVG5gVP', 'maxFileSizeTotal' => '2', 'fields' => array( array( 'fidx' => '0', 'name' => 'Name', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '1', 'name' => 'E-mail', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '2', 'name' => 'Phone Number', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '3', 'name' => 'Message', 'type' => 'textarea', 'required' => 1, 'options' => '' ), array( 'fidx' => '4', 'name' => 'Keep me in the uniQ circle, Subscribe me to specials &amp;amp; news', 'type' => 'checkbox', 'required' => 0, 'options' => '' ) ) )
		),
		'13'	=> array(
			'50f9dce1' => Array( 'email' => 'noreply@uniqmoves.com', 'emailFrom' => 'my@uniqmoves.com', 'subject' => 'Enquire from Private Coaching', 'sentMessage' => unserialize('s:54:"Ta da! Please Check Your Inbox For Confirmation E-mail";'), 'object' => '', 'objectRenderer' => '', 'loggingHandler' => '', 'smtpEnable' => true, 'smtpHost' => 'smtp.hostinger.com', 'smtpPort' => 587, 'smtpEncryption' => 'tls', 'smtpUsername' => 'my@uniqmoves.com', 'smtpPassword' => 'Ability440744.', 'recSiteKey' => '6LdehtcUAAAAAA2wD37XS6uta6FBkZB_NKP9Nvon', 'recSecretKey' => '6LdehtcUAAAAAHFHNdtL5sW1EVunDncr2YHTeUnk', 'maxFileSizeTotal' => '2', 'fields' => array( array( 'fidx' => '0', 'name' => 'Full Name', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '1', 'name' => 'E-mail', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '2', 'name' => 'City / Suburb', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '3', 'name' => 'Date of Birth', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '4', 'name' => 'Phone Number', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '5', 'name' => 'How often?', 'type' => 'select', 'required' => 1, 'options' => 'I want to try Personal Training;Once a week;Twice a week;Three times week;I\'d like to purchase 5 pack;I\'d like to purchase 10 pack' ), array( 'fidx' => '6', 'name' => 'Message', 'type' => 'textarea', 'required' => 1, 'options' => '' ), array( 'fidx' => '7', 'name' => 'I want to keep myself in&amp;nbsp;the Move, so Please subcribe me', 'type' => 'checkbox', 'required' => 0, 'options' => '' ) ) )
		),
		'10'	=> array(
			'4888019c' => Array( 'email' => 'noreply@uniqmoves.com', 'emailFrom' => 'my@uniqmoves.com', 'subject' => 'Advice From Shop Page', 'sentMessage' => unserialize('s:43:"Your Message Carefully Flew to Our Director";'), 'object' => '', 'objectRenderer' => '', 'loggingHandler' => '', 'smtpEnable' => true, 'smtpHost' => 'smtp.hostinger.com', 'smtpPort' => 587, 'smtpEncryption' => 'tls', 'smtpUsername' => 'my@uniqmoves.com', 'smtpPassword' => 'Ability440744.', 'recSiteKey' => '6LdyhtcUAAAAAE_BGmnR3EM6g-suuRJLeDGCiiDT', 'recSecretKey' => '6LdyhtcUAAAAAP1J2KN1c-3_2_6SfKAx4yU9vCuU', 'maxFileSizeTotal' => '2', 'fields' => array( array( 'fidx' => '0', 'name' => 'Full Name', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '1', 'name' => 'E-mail', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '2', 'name' => 'City / Suburb', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '3', 'name' => 'Phone Number', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '4', 'name' => 'What would you like see here?', 'type' => 'select', 'required' => 1, 'options' => 'Wooden Parallets Bar;High Parallet Bars;Handstand Blocks;Block Chalk;Liquid Chalk;Wooden Rings;Calisthenics Technic Book;Gymnastics Training Guide;Climbing Rope;Handstand Canes;Aerial Yoga Hammocks;Resistance Bands;or Something Else Please Mention it on Message Box' ), array( 'fidx' => '5', 'name' => 'Message', 'type' => 'textarea', 'required' => 1, 'options' => '' ), array( 'fidx' => '6', 'name' => 'I want to keep myself uniQ Circle&amp;nbsp;, so Please subcribe me', 'type' => 'checkbox', 'required' => 0, 'options' => '' ) ) )
		),
		'15'	=> array(
			'240c4cd2' => Array( 'email' => 'noreply@uniqmoves.com', 'emailFrom' => 'my@uniqmoves.com', 'subject' => 'Enquire from Private Coaching', 'sentMessage' => unserialize('s:54:"Ta da! Please Check Your Inbox For Confirmation E-mail";'), 'object' => '', 'objectRenderer' => '', 'loggingHandler' => '', 'smtpEnable' => true, 'smtpHost' => 'smtp.hostinger.com', 'smtpPort' => 587, 'smtpEncryption' => 'tls', 'smtpUsername' => 'my@uniqmoves.com', 'smtpPassword' => 'Ability440744.', 'recSiteKey' => '6LdehtcUAAAAAA2wD37XS6uta6FBkZB_NKP9Nvon', 'recSecretKey' => '6LdehtcUAAAAAHFHNdtL5sW1EVunDncr2YHTeUnk', 'maxFileSizeTotal' => '2', 'fields' => array( array( 'fidx' => '0', 'name' => 'Full Name', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '1', 'name' => 'E-mail', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '2', 'name' => 'Country', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '3', 'name' => 'City / Suburb', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '4', 'name' => 'Date of Birth', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '5', 'name' => 'Phone Number', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '6', 'name' => 'How often?', 'type' => 'select', 'required' => 1, 'options' => 'I want to try Online Training;Single Session;I want to get my uniQ movement' ), array( 'fidx' => '7', 'name' => 'Message', 'type' => 'textarea', 'required' => 1, 'options' => '' ), array( 'fidx' => '8', 'name' => 'I want to keep myself in&amp;nbsp;the Move, so Please subcribe me', 'type' => 'checkbox', 'required' => 0, 'options' => '' ) ) )
		)
	);
	$langs = null;
	$def_lang = null;
	$base_lang = 'en';
	$site_id = "e9ba5a69";
	$websiteUID = "2dfc84158a42a7573ae7230e2e860ea02cfe471bd28054f309812038ab0dc1ba8a26ec8d1424592c";
	$base_dir = dirname(__FILE__);
	$base_url = '/';
	$user_domain = 'uniqmoves.com';
	$home_page = '1';
	$mod_rewrite = true;
	$show_comments = false;
	$comment_callback = "http://uk.zyro.com/comment_callback/";
	$user_key = "zb3vGxrDjxtk75pUQg==";
	$user_hash = "daba88a259faad89";
	$ga_code = (is_file($ga_code_file = dirname(__FILE__).'/ga_code') ? file_get_contents($ga_code_file) : null);
	require_once dirname(__FILE__).'/src/SiteInfo.php';
	require_once dirname(__FILE__).'/src/SiteModule.php';
	require_once dirname(__FILE__).'/functions.inc.php';
	require_once dirname(__FILE__).'/src/store/StoreRegion.php';
	require_once dirname(__FILE__).'/src/store/StoreCountry.php';
	require_once dirname(__FILE__).'/src/store/StoreNavigation.php';
	require_once dirname(__FILE__).'/src/store/StoreData.php';
	require_once dirname(__FILE__).'/src/store/StoreModuleBuyer.php';
	require_once dirname(__FILE__).'/src/store/StoreModuleOrder.php';
	require_once dirname(__FILE__).'/src/store/StoreCurrency.php';
	require_once dirname(__FILE__).'/src/store/StorePriceOptions.php';
	require_once dirname(__FILE__).'/src/store/StoreModule.php';
	require_once dirname(__FILE__).'/src/store/StoreBillingInfo.php';
	require_once dirname(__FILE__).'/src/store/StoreCartData.php';
	require_once dirname(__FILE__).'/src/store/StoreCartApi.php';
	require_once dirname(__FILE__).'/src/store/StorePaymentApi.php';
	require_once dirname(__FILE__).'/src/store/StoreBaseElement.php';
	require_once dirname(__FILE__).'/src/store/StoreElement.php';
	require_once dirname(__FILE__).'/src/store/StoreCartElement.php';
	$siteInfo = SiteInfo::build(array('siteId' => $site_id, 'websiteUID' => $websiteUID, 'domain' => $user_domain, 'homePageId' => $home_page, 'baseDir' => $base_dir, 'baseUrl' => $base_url, 'defLang' => $def_lang, 'baseLang' => $base_lang, 'userKey' => $user_key, 'userHash' => $user_hash, 'commentsCallback' => $comment_callback, 'langs' => $langs, 'pages' => $pages, 'forms' => $forms, 'modRewrite' => $mod_rewrite, 'gaCode' => $ga_code, 'gaAnonymizeIp' => false, 'port' => null, 'pathPrefix' => null, 'useTrailingSlashes' => true,));
	$requestInfo = SiteRequestInfo::build(array('requestUri' => getRequestUri($siteInfo->baseUrl),));
	SiteModule::init(null, $siteInfo);
	StoreModule::init((object) array(
		'gatewayConfig' => array()
	), $siteInfo);
	list($page_id, $lang, $urlArgs, $route) = parse_uri($siteInfo, $requestInfo);
	$preview = false;
	$lang = empty($lang) ? $def_lang : $lang;
	$requestInfo->{'page'} = (isset($pages[$page_id]) ? $pages[$page_id] : null);
	$requestInfo->{'lang'} = $lang;
	$requestInfo->{'urlArgs'} = $urlArgs;
	$requestInfo->{'route'} = $route;
	handleTrailingSlashRedirect($siteInfo, $requestInfo);
	SiteModule::setLang($requestInfo->{'lang'});
	$hr_out = '';
	if (is_callable('StoreModule::parseRequest')) $hr_out .= call_user_func('StoreModule::parseRequest', $requestInfo);
	$page = $requestInfo->{'page'};
	if (!is_null($page)) {
		handleComments($page['id'], $siteInfo);
		if (isset($_POST["wb_form_id"])) handleForms($page['id'], $siteInfo);
	}
	ob_start();
	if ($page) {
		$fl = dirname(__FILE__).'/'.$page['file'];
		if (is_file($fl)) {
			ob_start();
			include $fl;
			$out = ob_get_clean();
			$ga_out = '';
			if ($lang && $langs) {
				foreach ($langs as $ln => $default) {
					$pageUri = getPageUri($page['id'], $ln, $siteInfo);
					$out = str_replace(urlencode('{{lang_'.$ln.'}}'), $pageUri, $out);
				}
			}
			if (is_file($ga_tpl = dirname(__FILE__).'/ga.php')) {
				ob_start(); include $ga_tpl; $ga_out = ob_get_clean();
			}
			$out = str_replace('<ga-code/>', $ga_out, $out);
			$out = str_replace('{{base_url}}', getBaseUrl(), $out);
			$out = str_replace('{{curr_url}}', getCurrUrl(), $out);
			$out = str_replace('{{hr_out}}', $hr_out, $out);
			header('Content-type: text/html; charset=utf-8', true);
			echo $out;
		}
	} else {
		header("Content-type: text/html; charset=utf-8", true, 404);
		if (is_file(dirname(__FILE__).'/404.html')) {
			include '404.html';
		} else {
			echo "<!DOCTYPE html>\n";
			echo "<html>\n";
			echo "<head>\n";
			echo "<title>404 Not found</title>\n";
			echo "</head>\n";
			echo "<body>\n";
			echo "404 Not found\n";
			echo "</body>\n";
			echo "</html>";
		}
	}
	ob_end_flush();

?>