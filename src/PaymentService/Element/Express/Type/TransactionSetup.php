<?php
namespace SinglePay\PaymentService\Element\Express\Type;

class TransactionSetup
{
    public $TransactionSetupID;

    public $TransactionSetupAccountID;

    public $TransactionSetupAcceptorID;

    public $TransactionSetupApplicationID;

    public $TransactionSetupApplicationName;

    public $TransactionSetupApplicationVersion;

    public $TransactionSetupMethod;

    public $Device;

    public $Embedded;

    public $CVVRequired;

    public $AutoReturn;

    public $CompanyName;

    public $LogoURL;

    public $Tagline;

    public $WelcomeMessage;

    public $ReturnURL;

    public $ReturnURLTitle;

    public $OrderDetails;

    public $ProcessTransactionTitle;

    public $ValidationCode;

    public $DeviceInputCode;

    public function __construct(
        $TransactionSetupID,
        $TransactionSetupAccountID,
        $TransactionSetupAcceptorID,
        $TransactionSetupApplicationID,
        $TransactionSetupApplicationName,
        $TransactionSetupApplicationVersion,
        $TransactionSetupMethod,
        $Device,
        $Embedded,
        $CVVRequired,
        $AutoReturn,
        $CompanyName,
        $LogoURL,
        $Tagline,
        $WelcomeMessage,
        $ReturnURL,
        $ReturnURLTitle,
        $OrderDetails,
        $ProcessTransactionTitle,
        $ValidationCode,
        $DeviceInputCode
    ){
        $this->TransactionSetupID = $TransactionSetupID;
        $this->TransactionSetupAccountID = $TransactionSetupAccountID;
        $this->TransactionSetupAcceptorID = $TransactionSetupAcceptorID;
        $this->TransactionSetupApplicationID = $TransactionSetupApplicationID;
        $this->TransactionSetupApplicationName = $TransactionSetupApplicationName;
        $this->TransactionSetupApplicationVersion = $TransactionSetupApplicationVersion;
        $this->TransactionSetupMethod = $TransactionSetupMethod;
        $this->Device = $Device;
        $this->Embedded = $Embedded;
        $this->CVVRequired = $CVVRequired;
        $this->AutoReturn = $AutoReturn;
        $this->CompanyName = $CompanyName;
        $this->LogoURL = $LogoURL;
        $this->Tagline = $Tagline;
        $this->WelcomeMessage = $WelcomeMessage;
        $this->ReturnURL = $ReturnURL;
        $this->ReturnURLTitle = $ReturnURLTitle;
        $this->OrderDetails = $OrderDetails;
        $this->ProcessTransactionTitle = $ProcessTransactionTitle;
        $this->ValidationCode = $ValidationCode;
        $this->DeviceInputCode = $DeviceInputCode;
    }
}