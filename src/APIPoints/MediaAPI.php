<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/25 0025
 * Time: 14:53
 */

namespace KaiHeiLaSDK\APIPoints;


use Psr\Http\Message\StreamInterface;

class MediaAPI extends BaseEndPoint
{
    public static function createAsset($file)
    {
        $data = [
            [
                'name' => 'file',
                'contents' => $file
            ]
        ];

        return self::getFetcher()->multiPartCall('api/v3/asset/create',$data);
    }
}
