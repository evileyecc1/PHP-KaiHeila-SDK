<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/25 0025
 * Time: 14:06
 */

namespace KaiHeiLaSDK\APIPoints;


class GatewayAPI extends BaseEndPoint
{
    public static function getGateway($compress = 1)
    {
        return self::getFetcher()->call('get', 'api/v3/gateway/index', ['compress'=>$compress]);
    }
}
