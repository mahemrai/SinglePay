<?php
namespace SinglePay\Entity;

/**
 * Order class
 * @author Mahendra Rai
 */
class Order
{
    /**
     * @var string
     */
    protected $amount;

    /**
     * @var string
     */
    protected $customerNo;

    /**
     * Set order amount.
     * @param  string $amount
     * @return Order
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Get order amount.
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set customer number for order.
     * @param  string $customerNo
     * @return Order
     */
    public function setCustomerNo($customerNo)
    {
        $this->customerNo = $customerNo;
        return $this;
    }

    /**
     * Get customer number for order.
     * @return string
     */
    public function getCustomerNo()
    {
        return $this->customerNo;
    }
}