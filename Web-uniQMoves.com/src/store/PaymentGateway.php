<?php

abstract class PaymentGateway {
	
	/** @var stdClass */
	protected $config;
	private $lastError = null;
	
	protected $returnAfterCallback = false;
	
	public function __construct(stdClass $config = null) {
		$this->config = ($config && is_object($config)) ? $config : new stdClass();
		$this->init();
	}
	
	/**
	 * Initiates class.
	 */
	public function init() {}
	
	/**
	 * Get order transaction ID during gateway callback
	 * @return string
	 */
	public abstract function getTransactionId();
	
	/**
	 * Get client info array during gateway callback
	 * @return array|null
	 */
	public function getClientInfo() {
		return null;
	}
	
	/**
	 * Gets last error if set.
	 * @return mixed
	 */
	public function getLastError() {
		return $this->lastError;
	}
	
	/**
	 * Sets last error if needed. 
	 * @param mixed $error
	 */
	public function setLastError($error) {
		$this->lastError = $error;
	}

	/**
	 * Gets POST parameter
	 * @param string $name
	 * @param mixed $default
	 * @return string|null
	 */
	protected function getFormParam($name, $default = null) {
		if (isset($_POST[$name])) {
			return $_POST[$name];
		}
		return $default;
	}
	
	/**
	 * Gets GET parameter
	 * @param string $name
	 * @param mixed $default
	 * @return string|null
	 */
	protected function getQueryParam($name, $default = null) {
		if (isset($_GET[$name])) {
			return $_GET[$name];
		}
		return $default;
	}
	
	/**
	 * If true then return action should be made
	 * right after callback action.
	 * @return boolean
	 */
	public function doReturnAfterCallback() {
		return $this->returnAfterCallback;
	}

	/**
	 * Returns new form HTML fields if needed
	 * to be inserted to gateway form before submit.
	 * @param array $formVars
	 * @return string[]
	 */
	public function createFormFields($formVars) {}
	
	/**
	 * Returns URL which payment gateway should redirect by.
	 * @param array $formVars
	 * @return string
	 */
	public function createRedirectUrl($formVars) {}
	
	/**
	 * Triggers payment callback script.
	 * @return boolean indicating if callback was successful.
	 * In case of "false" order is not marked as complete.
	 */
	public function callback(StoreModuleOrder $order = null) {
		return true;
	}
	
	/**
	 * Triggers payment verification script.
	 */
	public function verify(StoreModuleOrder $order = null) {}
	
	/**
	 * Triggers payment cancellation script.
	 */
	public function cancel() {}
	
	/**
	 * Triggers payment return script.
	 */
	public function completeCheckout() {}
	
}
