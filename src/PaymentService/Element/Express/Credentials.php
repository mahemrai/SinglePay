<?php
namespace SinglePay\PaymentService\Element\Express;

class Credentials
{
	public $accountId;

	public $accountToken;

	public $acceptorId;

	public $newAccountToken;

	public function __construct($accountId, $accountToken, $acceptorId, $newAccountToken = null)
	{
		$this->accountId = $accountId;
		$this->accountToken = $accountToken;
		$this->acceptorId = $acceptorId;
		$this->newAccountToken = $newAccountToken;
	}
}