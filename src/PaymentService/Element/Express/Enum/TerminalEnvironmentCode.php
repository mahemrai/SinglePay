<?php
namespace SinglePay\PaymentService\Element\Express\Enum;

class TerminalEnvironmentCode
{
    const __default = 'UseDefault';
    const UseDefault = 'UseDefault';
    const NoTerminal = 'NoTerminal';
    const LocalAttended = 'LocalAttended';
    const LocalUnattended = 'LocalUnattended';
    const RemoteAttended = 'RemoteAttended';
    const RemoteUnattended = 'RemoteUnattended';
    const ECommerce = 'ECommerce';
}