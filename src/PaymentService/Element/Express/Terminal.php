<?php
namespace SinglePay\PaymentService\Element\Express;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
class Terminal
{
    public $terminalId;

    public $cardHolderPresentCode;

    public $cardInputCode;

    public $terminalCapabilityCode;

    public $terminalEnvironmentCode;

    public $cardPresentCode;

    public $motoECICode;

    public $cvvPresentCode;

    public function __construct(
        $terminalId,
        $cardHolderPresentCode,
        $cardInputCode,
        $terminalCapabilityCode,
        $terminalEnvironmentCode,
        $cardPresentCode,
        $motoECICode,
        $cvvPresentCode
    ) {
        $this->terminalId = $terminalId;
        $this->cardHolderPresentCode = $cardHolderPresentCode;
        $this->cardInputCode = $cardInputCode;
        $this->terminalCapabilityCode = $terminalCapabilityCode;
        $this->terminalEnvironmentCode = $terminalEnvironmentCode;
        $this->cardPresentCode = $cardPresentCode;
        $this->motoECICode = $motoECICode;
        $this->cvvPresentCode = $cvvPresentCode;
    }
}