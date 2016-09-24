<?php
namespace SinglePay\PaymentService;

/**
 * ConfigValidator abstract class
 * @author Mahendra Rai
 */
abstract class ConfigValidator
{
    /**
     * @param  array  $config
     * @return mixed
     */
    abstract public function validate($config);
}