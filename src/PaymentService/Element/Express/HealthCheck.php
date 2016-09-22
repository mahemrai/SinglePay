<?php
namespace SinglePay\PaymentService\Element\Express;

class HealthCheck
{
	public $credentials;

	public $application;

	public function __construct(Credentials $credentials, Application $application)
	{
		$this->credentials = $credentials;
		$this->application = $application;
	}
}