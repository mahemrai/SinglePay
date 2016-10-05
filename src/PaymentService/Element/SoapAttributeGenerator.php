<?php
namespace SinglePay\PaymentService\Element;

/**
 * SoapAttributeGenerator class
 * @author Mahendra Rai
 */
class SoapAttributeGenerator
{
	/**
	 * @param  string     $type
	 * @param  string     $attributeKey
	 * @param  mixed      $attributeValue
	 * @throws \Exception
	 * @return \SoapVar
	 */
    public static function createSoapAttribute($type, $attributeKey, $attributeValue)
    {
    	if (is_null($type)) {
    		throw new \Exception("Parameter 'type' is required to create a soap attribute.");
    	}

    	if (is_null($attributeKey)) {
    		throw new \Exception("Parameter 'attributeKey' is required to create a soap attribute.");
    	}

    	if (is_null($attributeValue)) {
    		throw new \Exception("Parameter 'attributeValue' is required to create a soap attribute.");
    	}

        $xml = "<ns1:Value xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:type='ns1:{$type}'><ns1:{$attributeKey}>{$attributeValue}</ns1:{$attributeKey}></ns1:Value>";
        return new \SoapVar($xml, XSD_ANYXML);
    }
}