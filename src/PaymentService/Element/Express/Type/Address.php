<?php
namespace SinglePay\PaymentService\Element\Express\Type;

class Address
{
    public $BillingName;

    public $BillingAddress1;

    public $BillingAddress2;

    public $BillingCity;

    public $BillingState;

    public $BillingZipcode;

    public $BillingEmail;

    public $BillingPhone;

    public $ShippingName;

    public $ShippingAddress1;

    public $ShippingAddress2;

    public $ShippingCity;

    public $ShippingState;

    public $ShippingZipcode;

    public $ShippingEmail;

    public $ShippingPhone;

    public function __construct(
        $billingName,
        $billingAddress1,
        $billingAddress2,
        $billingCity,
        $billingState,
        $billingZipcode,
        $billingEmail,
        $billingPhone,
        $shippingName,
        $shippingAddress1,
        $shippingAddress2,
        $shippingCity,
        $shippingState,
        $shippingZipcode,
        $shippingEmail,
        $shippingPhone
    ) {
        $this->BillingName = $billingName;
        $this->BillingAddress1 = $billingAddress1;
        $this->BillingAddress2 = $billingAddress2;
        $this->BillingCity = $billingCity;
        $this->BillingState = $billingState;
        $this->BillingZipcode = $billingZipcode;
        $this->BillingEmail = $billingEmail;
        $this->BillingPhone = $billingPhone;
        $this->ShippingName = $shippingName;
        $this->ShippingAddress1 = $shippingAddress1;
        $this->ShippingAddress2 = $shippingAddress2;
        $this->ShippingCity = $shippingCity;
        $this->ShippingState = $shippingState;
        $this->ShippingZipcode = $shippingZipcode;
        $this->ShippingEmail = $shippingEmail;
        $this->ShippingPhone = $shippingPhone;
    }
}