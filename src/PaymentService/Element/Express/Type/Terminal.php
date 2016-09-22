<?php
namespace SinglePay\PaymentService\Element\Express\Type;

class Terminal
{
    public $TerminalID;

    public $TerminalType;

    public $CardPresentCode;

    public $CardholderPresentCode;

    public $CardInputCode;

    public $CVVPresenceCode;

    public $TerminalCapabilityCode;

    public $TerminalEnvironmentCode;

    public $MotoECICode;

    public $CVVResponseType;

    public $ConsentCode;

    public $TerminalSerialNumber;

    public $TerminalEncryptionFormat;

    public $LaneNumber;

    public $Model;

    public $EMVKernelVersion;

    public function __construct(
        $terminalId,
        $terminalType,
        $cardPresentCode,
        $cardHolderPresentCode,
        $cardInputCode,
        $cvvPresentCode,
        $terminalCapabilityCode,
        $terminalEnvironmentCode,
        $motoECICode,
        $cvvResponseType,
        $consentCode,
        $terminalSerialNumber,
        $terminalEncryptionFormat,
        $laneNumber,
        $model,
        $emvKernelVersion
    ){
        $this->TerminalID = $terminalId;
        $this->TerminalType = $terminalType;
        $this->CardPresentCode = $cardPresentCode;
        $this->CardholderPresentCode = $cardHolderPresentCode;
        $this->CardInputCode = $cardInputCode;
        $this->CVVPresenceCode = $cvvPresentCode;
        $this->TerminalCapabilityCode = $terminalCapabilityCode;
        $this->TerminalEnvironmentCode = $terminalEnvironmentCode;
        $this->MotoECICode = $motoECICode;
        $this->CVVResponseType = $cvvResponseType;
        $this->ConsentCode = $consentCode;
        $this->TerminalSerialNumber = $terminalSerialNumber;
        $this->TerminalEncryptionFormat = $terminalEncryptionFormat;
        $this->LaneNumber = $laneNumber;
        $this->Model = $model;
        $this->EMVKernelVersion = $emvKernelVersion;
    }
}