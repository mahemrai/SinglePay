<?php
namespace SinglePay\Entity;

/**
 * Address class
 * @package SinglePay
 * @author  Mahendra Rai
 */
class Address
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $address1;

    /**
     * @var string
     */
    protected $address2;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var string
     */
    protected $zipcode;

    /**
     * Set value of name.
     * @param  string $name
     * @return Address
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
     * Set value of address1.
     * @param  string $address1
     * @return Address
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
        return $this;
    }

    /**
     * Get value of address1.
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set value of address2.
     * @param  string $address2
     * @return Address
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
        return $this;
    }

    /**
     * Get value of address2.
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set value of city.
     * @param  string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Get value of city.
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set value of email.
     * @param  string $email
     * @return Address
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get value of email.
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set value of phone.
     * @param  string $phone
     * @return Address
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Get value of phone.
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set value of state.
     * @param  string $state
     * @return Address
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get value of state.
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set value of zipcode.
     * @param  string $zipcode
     * @return Address
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * Get value of zipcode.
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }
}