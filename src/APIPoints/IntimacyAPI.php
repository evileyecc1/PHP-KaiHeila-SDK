<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/25 0025
 * Time: 15:25
 */

namespace KaiHeiLaSDK\APIPoints;


class IntimacyAPI extends BaseEndPoint
{
    public static function getInitmacy($user_id)
    {
        $data = ['user_id' => $user_id];

        return self::getFetcher()->call('get', 'api/v3/intimacy/index', $data);
    }

    public static function updateInitmacy($user_id, $score = null, $social_info = null, $img_id = null)
    {
        $data = ['user_id' => $user_id, 'score' => $score, 'social_info' => $social_info, 'img_id' => $img_id];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('get', 'api/v3/intimacy/update', $data);
    }
}
