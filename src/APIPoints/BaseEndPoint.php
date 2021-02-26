<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/20 0020
 * Time: 11:47
 */

namespace KaiHeiLaSDK\APIPoints;


use KaiHeiLaSDK\Configuration;
use KaiHeiLaSDK\Fetchers\FetcherInterface;

class BaseEndPoint
{
    /**
     * @var
     */
    protected static $fetcher;


    public static function getConfiguration(): Configuration
    {

        return Configuration::getInstance();
    }

    public static function getFetcher(): FetcherInterface
    {

        if (! self::$fetcher) {

            $fetcher_class = self::getConfiguration()->fetcher;
            self::$fetcher = new $fetcher_class();

        }

        return self::$fetcher;
    }

    public static function cleanRequestData($data)
    {
        return array_filter($data,function($v,$k){
            return $v !== null;
        },ARRAY_FILTER_USE_BOTH);
    }
}
