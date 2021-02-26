<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/25 0025
 * Time: 16:01
 */

namespace KaiHeiLaSDK\Log;


use KaiHeiLaSDK\Configuration;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class RotatingFileLogger implements LogInterface
{
    /**
     * @var \Monolog\Logger
     */
    protected $logger;

    /**
     * FileLogger constructor.
     * @throws \Exception
     */
    public function __construct()
    {

        // Get the configuration values
        $configuration = Configuration::getInstance();

        $formatter = new LineFormatter("[%datetime%] %channel%.%level_name%: %message%\n");
        $stream = new RotatingFileHandler(
            rtrim($configuration->logfile_location, '/') . '/khl-sdk.log',
            $configuration->log_max_files,
            $configuration->logger_level
        );
        $stream->setFormatter($formatter);

        $this->logger = new Logger('khl-sdk');
        $this->logger->pushHandler($stream);
    }

    /**
     * @param string $message
     *
     * @return mixed|void
     */
    public function log(string $message)
    {

        $this->logger->info($message);
    }

    /**
     * @param string $message
     *
     * @return mixed|void
     */
    public function debug(string $message)
    {

        $this->logger->debug($message);
    }

    /**
     * @param string $message
     *
     * @return mixed|void
     */
    public function warning(string $message)
    {

        $this->logger->warning($message);
    }

    /**
     * @param string $message
     *
     * @return mixed|void
     */
    public function error(string $message)
    {

        $this->logger->error($message);
    }
}
