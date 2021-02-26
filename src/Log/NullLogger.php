<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/25 0025
 * Time: 15:56
 */

namespace KaiHeiLaSDK\Log;


class NullLogger implements LogInterface
{
    /**
     * @param string $message
     *
     * @return mixed
     */
    public function log(string $message)
    {

    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function debug(string $message)
    {

    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function warning(string $message)
    {

    }

    /**
     * @param string $message
     *
     * @return mixed
     */
    public function error(string $message)
    {

    }
}
