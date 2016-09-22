<?php
namespace SinglePay\PaymentService\Element\Express\Type;

class Transaction
{
    public $TransactionID;

    public $ClerkNumber;

    public $ShiftID;

    public $TransactionAmount;

    public $OriginalAuthorizedAmount;

    public $TotalAuthorizedAmount;

    public $SalesTaxAmount;

    public $TipAmount;

    public $ApprovalNumber;

    public $ReferenceNumber;

    public $TicketNumber;

    public $ReversalType;

    public $MarketCode;

    public $AcquirerData;

    public $CashBackAmount;

    public $BillPaymentFlag;

    public $DuplicateCheckDisableFlag;

    public $DuplicateOverrideFlag;

    public $RecurringFlag;

    public $CommercialCardCustomerCode;

    public $ProcessorName;

    public $TransactionStatus;

    public $TransactionStatusCode;

    public $HostTransactionID;

    public $TransactionSetupID;

    public $MerchantVerficationValue;

    public $PartialApprovedFlag;

    public $ApprovedAmount;

    public $CommercialCardResponseCode;

    public $BalanceAmount;

    public $BalanceCurrencyCode;

    public $ConvenienceFeeAmount;

    public $GiftCardStatusCode;

    public $BillPayerAccountNumber;

    public $GiftCardBalanceTransferCode;

    public $EMVEncryptionFormat;

    public $ReversalReason;

    public function __construct(
        $transactionId,
        $clerkNumber,
        $shiftId,
        $transactionAmount,
        $originalAuthorizedAmount,
        $totalAuthorizedAmount,
        $salesTaxAmount,
        $tipAmount,
        $approvalNumber,
        $referenceNumber,
        $ticketNumber,
        $reversalType,
        $marketCode,
        $acquirerData,
        $cashbackAmount,
        $billPaymentFlag,
        $duplicateCheckDisableFlag,
        $duplicateOverrideFlag,
        $recurringFlag,
        $commercialCardCustomerCode,
        $processorName,
        $transactionStatus,
        $transactionStatusCode,
        $hostTransactionId,
        $transactionSetupId,
        $merchantVerificationValue,
        $partialApprovedFlag,
        $approvedAmount,
        $commercialCardResponseCode,
        $balanceAmount,
        $balanceCurrencyCode,
        $convenienceFeeAmount,
        $giftCardStatusCode,
        $billPayerAccountNumber,
        $giftCardBalanceTransferCode,
        $emvEncryptionFormat,
        $reversalReason
    ){
        $this->TransactionID = $transactionId;
        $this->ClerkNumber = $clerkNumber;
        $this->ShiftID = $shiftId;
        $this->TransactionAmount = $transactionAmount;
        $this->OriginalAuthorizedAmount = $originalAuthorizedAmount;
        $this->TotalAuthorizedAmount = $totalAuthorizedAmount;
        $this->SalesTaxAmount = $salesTaxAmount;
        $this->TipAmount = $tipAmount;
        $this->ApprovalNumber = $approvalNumber;
        $this->ReferenceNumber = $referenceNumber;
        $this->TicketNumber = $ticketNumber;
        $this->ReversalType = $reversalType;
        $this->MarketCode = $marketCode;
        $this->AcquirerData = $acquirerData;
        $this->CashBackAmount = $cashbackAmount;
        $this->BillPaymentFlag = $billPaymentFlag;
        $this->DuplicateCheckDisableFlag = $duplicateCheckDisableFlag;
        $this->DuplicateOverrideFlag = $duplicateOverrideFlag;
        $this->RecurringFlag = $recurringFlag;
        $this->CommercialCardCustomerCode = $commercialCardCustomerCode;
        $this->ProcessorName = $processorName;
        $this->TransactionStatus = $transactionStatus;
        $this->TransactionStatusCode = $transactionStatusCode;
        $this->HostTransactionID = $hostTransactionId;
        $this->TransactionSetupID = $transactionSetupId;
        $this->MerchantVerficationValue = $merchantVerificationValue;
        $this->PartialApprovedFlag = $partialApprovedFlag;
        $this->ApprovedAmount = $approvedAmount;
        $this->CommercialCardResponseCode = $commercialCardResponseCode;
        $this->BalanceAmount = $balanceAmount;
        $this->BalanceCurrencyCode = $balanceCurrencyCode;
        $this->ConvenienceFeeAmount = $convenienceFeeAmount;
        $this->GiftCardStatusCode = $giftCardStatusCode;
        $this->BillPayerAccountNumber = $billPayerAccountNumber;
        $this->GiftCardBalanceTransferCode = $giftCardBalanceTransferCode;
        $this->EMVEncryptionFormat = $emvEncryptionFormat;
        $this->ReversalReason = $reversalReason;
    }
}