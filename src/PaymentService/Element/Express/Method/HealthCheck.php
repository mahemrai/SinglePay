<?php
namespace SinglePay\PaymentService\Element\Express\Method;

use SinglePay\PaymentService\Element\Express\Type\Application;
use SinglePay\PaymentService\Element\Express\Type\Credentials;

class HealthCheck
{
	public $credentials;

	public $application;

	public function __construct($credentials, $application)
	{
		$this->credentials = $credentials;
		$this->application = $application;
	}
}