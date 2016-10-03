<?php
namespace SinglePay\PaymentService\Element;

class SoapAttributeGenerator
{
    public static function createSoapAttribute($type, $attributeKey, $attributeValue)
    {
        $xml = "<ns1:Value xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:type='ns1:{$type}'><ns1:{$attributeKey}>{$attributeValue}</ns1:{$attributeKey}></ns1:Value>";
        return new \SoapVar($xml, XSD_ANYXML);
    }
}