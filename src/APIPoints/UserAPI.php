<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/25 0025
 * Time: 14:05
 */

namespace KaiHeiLaSDK\APIPoints;


class UserAPI extends BaseEndPoint
{
    public static function getMe()
    {
        return self::getFetcher()->call('get', 'api/v3/user/me', []);
    }
}
