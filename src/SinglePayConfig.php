<?php
namespace SinglePay;

/**
 * @package SinglePay
 * @author  Mahendra Rai
 */
class SinglePayConfig
{
    /**
     * @var string
     */
    protected $serviceName;

    /**
     * @var array
     */
    protected $serviceConfig;

    /**
     * Get name of the payment service.
     * @return string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * Set name of the payment service.
     * @param  string $name
     * @return Config
     */
    public function setServiceName($name)
    {
        $this->serviceName = $name;
        return $this;
    }

    /**
     * Get configuration of the payment service.
     * @return array
     */
    public function getServiceConfig()
    {
        return $this->serviceConfig;
    }

    /**
     * Set configuration of the payment service.
     * @param  array $config
     * @return Config
     */
    public function setServiceConfig($config)
    {
        $this->serviceConfig = $config;
        return $this;
    }

}