<?php
namespace SinglePay\PaymentService\Element\Express;

class Application
{
	public $applicationId;

	public $applicationName;

	public $applicationVersion;

	public function __construct($applicationId, $applicationName, $applicationVersion)
	{
		$this->applicationId = $applicationId;
		$this->applicationName = $applicationName;
		$this->applicationVersion = $applicationVersion;
	}
}