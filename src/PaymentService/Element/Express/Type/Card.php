<?php
namespace SinglePay\PaymentService\Element\Express\Type;

class Card
{
    public $Track1Data;

    public $Track2Data;

    public $Track3Data;

    public $MagneprintData;

    public $CardNumber;

    public $TruncatedCardNumber;

    public $ExpirationMonth;

    public $ExpirationYear;

    public $CardHolderName;

    public $CVV;

    public $CAVV;

    public $XID;

    public $PINBlock;

    public $KeySerialNumber;

    public $EncryptedFormat;

    public $EncryptedTrack1Data;

    public $EncryptedTrack2Data;

    public $EncryptedCardData;

    public $CardDataKeySerialNumber;

    public $AVSResponseCode;

    public $CVVResponseCode;

    public $CAVVResponseCode;

    public $CardLogo;

    public $GiftCardSecurityLogo;

    public $AlternateCardNumber1;

    public $AlternateCardNumber2;

    public $AlternateCardNumber3;

    public function __construct(
        $Track1Data,
        $Track2Data,
        $Track3Data,
        $MagneprintData,
        $CardNumber,
        $TruncatedCardNumber,
        $ExpirationMonth,
        $ExpirationYear,
        $CardHolderName,
        $CVV,
        $CAVV,
        $XID,
        $PINBlock,
        $KeySerialNumber,
        $EncryptedFormat,
        $EncryptedTrack1Data,
        $EncryptedTrack2Data,
        $EncryptedCardData,
        $CardDataKeySerialNumber,
        $AVSResponseCode,
        $CVVResponseCode,
        $CAVVResponseCode,
        $CardLogo,
        $GiftCardSecurityLogo,
        $AlternateCardNumber1,
        $AlternateCardNumber2,
        $AlternateCardNumber3
    ){
        $this->Track1Data = $Track1Data;
        $this->Track2Data = $Track2Data;
        $this->Track3Data = $Track3Data;
        $this->MagneprintData = $MagneprintData;
        $this->CardNumber = $CardNumber;
        $this->TruncatedCardNumber = $TruncatedCardNumber;
        $this->ExpirationMonth = $ExpirationMonth;
        $this->ExpirationYear = $ExpirationYear;
        $this->CardHolderName = $CardHolderName;
        $this->CVV = $CVV;
        $this->CAVV = $CAVV;
        $this->XID = $XID;
        $this->PINBlock = $PINBlock;
        $this->KeySerialNumber = $KeySerialNumber;
        $this->EncryptedFormat = $EncryptedFormat;
        $this->EncryptedTrack1Data = $EncryptedTrack1Data;
        $this->EncryptedTrack2Data = $EncryptedTrack2Data;
        $this->EncryptedCardData = $EncryptedCardData;
        $this->CardDataKeySerialNumber = $CardDataKeySerialNumber;
        $this->AVSResponseCode = $AVSResponseCode;
        $this->CVVResponseCode = $CVVResponseCode;
        $this->CAVVResponseCode = $CAVVResponseCode;
        $this->CardLogo = $CardLogo;
        $this->GiftCardSecurityLogo = $GiftCardSecurityLogo;
        $this->AlternateCardNumber1 = $AlternateCardNumber1;
        $this->AlternateCardNumber2 = $AlternateCardNumber2;
        $this->AlternateCardNumber3 = $AlternateCardNumber3;
    }
}