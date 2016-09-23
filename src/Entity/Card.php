<?php
namespace SinglePay\Entity;

/**
 * Card class
 * @package SinglePay
 * @author  Mahendra Rai
 */
class Card
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $number;

    /**
     * @var string
     */
    protected $expiryMonth;

    /**
     * @var string
     */
    protected $expiryYear;

    /**
     * @var string
     */
    protected $scheme;

    /**
     * @var int
     */
    protected $cvv;

    /**
     * @var string
     */
    protected $token;

    /**
     * Set value of name.
     * @param  string $name
     * @return Card
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get value of name.
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value of number.
     * @param  int $number
     * @return Card
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get value of number.
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set value of expiry month.
     * @param  string $expiryMonth
     * @return Card
     */
    public function setExpiryMonth($expiryMonth)
    {
        $this->expiryMonth = $expiryMonth;
        return $this;
    }

    /**
     * Get value of expiry month.
     * @return string
     */
    public function getExpiryMonth()
    {
        return $this->expiryMonth;
    }

    /**
     * Set value of expiry year.
     * @param  string $expiryYear
     * @return Card
     */
    public function setExpiryYear($expiryYear)
    {
        $this->expiryYear = $expiryYear;
        return $this;
    }

    /**
     * Get value of expiry year.
     * @return string
     */
    public function getExpiryYear()
    {
        return $this->expiryYear;
    }

    /**
     * Set value of scheme.
     * @param  string $scheme
     * @return Card
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * Get value of scheme.
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Set value of CVV.
     * @param  int $cvv
     * @return Card
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
        return $this;
    }

    /**
     * Get value of CVV.
     * @return int
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * Set value of token.
     * @param  string $token
     * @return Card
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Get value of token.
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}