<?php
namespace SinglePay\PaymentService\Element\Express\Type;

class Credentials
{
	public $AccountID;

	public $AccountToken;

	public $AcceptorId;

	public $NewAccountToken;

	public function __construct($accountId, $accountToken, $acceptorId, $newAccountToken = NULL)
	{
		$this->AccountID = $accountId;
		$this->AccountToken = $accountToken;
		$this->AcceptorID = $acceptorId;
		$this->NewAccountToken = $newAccountToken;
	}
}