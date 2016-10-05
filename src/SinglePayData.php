<?php
namespace SinglePay;

use SinglePay\Entity\Address;
use SinglePay\Entity\Card;
use SinglePay\Entity\Order;

/**
 * SinglePayData class
 * @package SinglePay
 * @author  Mahendra Rai
 */
class SinglePayData
{
    /**
     * @var int
     */
    protected $customerNo;

    /**
     * @var string
     */
    protected $orderAmount;

    /**
     * @var Order
     */
    protected $order;

    /**
     * @var Card
     */
    protected $card;

    /**
     * @var Address
     */
    protected $billingAddress;

    /**
     * @var Address
     */
    protected $shippingAddress;

    /**
     * @var array
     */
    protected $extras;

    /**
     * Set customer number.
     * @param  int $customerNo
     * @return SinglePayData
     */
    public function setCustomerNo($customerNo)
    {
        $this->customerNo = $customerNo;
        return $this;
    }

    /**
     * Get customer number.
     * @return int
     */
    public function getCustomerNo()
    {
        return $this->customerNo;
    }

    /**
     * Set value of order amount.
     * @param  string  $orderAmount
     * @return SinglePayData
     */
    public function setOrderAmount($orderAmount)
    {
        $this->orderAmount = $orderAmount;
        return $this;
    }

    /**
     * Get value of order amount.
     * @return string
     */
    public function getOrderAmount()
    {
        return $this->orderAmount;
    }

    /**
     * Set order.
     * @param  Order         $order
     * @return SinglePayData
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get order.
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set card.
     * @param  Card          $card
     * @return SinglePayData
     */
    public function setCard(Card $card)
    {
        $this->card = $card;
        return $this;
    }

    /**
     * Get card.
     * @return Card
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * Set billing address.
     * @param  Address  $billingAddress
     * @return SinglePayData
     */
    public function setBillingAddress(Address $billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    /**
     * Get billing address.
     * @return Address
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * Set shipping address.
     * @param  Address  $shippingAddress
     * @return SinglePayData
     */
    public function setShippingAddress(Address $shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    /**
     * Get shipping address.
     * @return Address
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * Set extra data.
     * @param  array $extras
     * @return SinglePayData
     */
    public function setExtras($extras)
    {
        $this->extras = $extras;
        return $this;
    }

    /**
     * Get extra data.
     * @return array
     */
    public function getExtras()
    {
        return $this->extras;
    }
}