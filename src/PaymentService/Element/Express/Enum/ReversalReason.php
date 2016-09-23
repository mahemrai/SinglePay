<?php
namespace SinglePay\PaymentService\Element\Express\Enum;

class ReversalReason
{
    const __default = 'Unknown';
    const Unknown = 'Unknown';
    const RejectedPartialApproval = 'RejectedPartialApproval';
    const Timeout = 'Timeout';
    const EditError = 'EditError';
    const MACVerifyError = 'MACVerifyError';
    const MACSyncError = 'MACSyncError';
    const EncryptionError = 'EncryptionError';
    const SystemError = 'SystemError';
    const PossibleFraud = 'PossibleFraud';
    const CardRemoval = 'CardRemoval';
    const ChipDecline = 'ChipDecline';
    const TerminalError = 'TerminalError';
}