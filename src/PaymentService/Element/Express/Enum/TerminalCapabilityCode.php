<?php
namespace SinglePay\PaymentService\Element\Express\Enum;

class TerminalCapabilityCode
{
    const __default = 'UseDefault';
    const UseDefault = 'UseDefault';
    const Unknown = 'Unknown';
    const NoTerminal = 'NoTerminal';
    const MagstripeReader = 'MagstripeReader';
    const ContactlessMagstripeReader = 'ContactlessMagstripeReader';
    const KeyEntered = 'KeyEntered';
    const ChipReader = 'ChipReader';
    const ContactlessChipReader = 'ContactlessChipReader';
}