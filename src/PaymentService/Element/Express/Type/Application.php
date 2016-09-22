<?php
namespace SinglePay\PaymentService\Element\Express\Type;

class Application
{
	public $ApplicationID;

	public $ApplicationName;

	public $ApplicationVersion;

	public function __construct($applicationId, $applicationName, $applicationVersion)
	{
		$this->ApplicationID = $applicationId;
		$this->ApplicationName = $applicationName;
		$this->ApplicationVersion = $applicationVersion;
	}
}