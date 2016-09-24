<?php
namespace SinglePay\PaymentService;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
interface PaymentServiceInterface
{
    /**
     * Perform health check of the payment service.
     * @return array
     */
    public function healthCheck();

    /**
     * Authorise payment card.
     * @param  boolean $useToken
     * @return array
     */
    public function authorise($useToken = false);

    /**
     * Process payment.
     * @return array
     */
    public function processPayment();

    /**
     * Refund paid amount.
     * @return array
     */
    public function refund();

    /**
     * Save payment card with a payment service.
     * @return array
     */
    public function saveCard();

    /**
     * Process payment with a card saved with a payment service.
     * @return array
     */
    public function payWithSavedCard();
}