<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/20 0020
 * Time: 11:18
 */

namespace KaiHeiLaSDK;


use KaiHeiLaSDK\Containers\KHLConfiguration;
use KaiHeiLaSDK\Exceptions\InvalidConfigurationException;
use KaiHeiLaSDK\Log\LogInterface;

class Configuration
{
    /**
     * @var Configuration
     */
    private static $instance;

    /**
     * @var LogInterface
     */
    protected $logger;

    /**
     * @var KHLConfiguration
     */
    protected $configuration;

    public function __construct()
    {
        $this->configuration = new KHLConfiguration();
    }

    public static function getInstance(): self
    {

        if (is_null(self::$instance))
            self::$instance = new self();

        return self::$instance;
    }

    public function getConfiguration()
    {

        return $this->configuration;
    }

    public function setConfiguration(KHLConfiguration $configuration)
    {

        if (! $configuration->valid())
            throw new InvalidConfigurationException(
                'The configuration is empty/invalid values');

        $this->configuration = $configuration;
    }

    public function getLogger(): LogInterface
    {

        if (! $this->logger)
            $this->logger = new $this->configuration->logger;

        return $this->logger;
    }

    /**
     * Magic method to get the configuration from the configuration
     * property.
     *
     * @param $name
     *
     * @return mixed
     */
    public function __get(string $name)
    {

        return $this->configuration->$name;
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return string
     */
    public function __set(string $name, string $value)
    {

        return $this->configuration->$name = $value;
    }
}
