<?php
namespace SinglePay\PaymentService;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
interface PaymentServiceInterface
{
    /**
     * @param  array $data
     */
    public function processPayment($data);

    /**
     * @param  array $data
     */
    public function refund($data);

    /**
     * @param  array $data
     */
    public function saveCard($data);

    /**
     * @param  array $data
     */
    public function payWithSavedCard($data);
}