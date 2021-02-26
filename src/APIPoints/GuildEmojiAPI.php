<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/25 0025
 * Time: 15:28
 */

namespace KaiHeiLaSDK\APIPoints;


class GuildEmojiAPI extends BaseEndPoint
{
    public static function getEmojiList($guild_id)
    {
        $data = ['guild_id' => $guild_id];

        return self::getFetcher()->call('get', 'api/v3/guild-emoji/index', $data);
    }

    public static function createEmoji($guild_id, $file, $name = null)
    {
        $data = [
            [
                'name' => 'guild_id',
                'contents' => $guild_id
            ],
            [
                'name' => 'emoji',
                'contents' => $file
            ]
        ];
        if($name){
            $data[] = [
                'name' => 'name',
                'contents' => $name
            ];
        }

        return self::getFetcher()->multiPartCall('api/v3/guild-emoji/create', $data);
    }

    public static function updateEmoji($id, $name)
    {
        $data = ['id' => $id,'name'=>$name];

        return self::getFetcher()->call('post', 'api/v3/guild-emoji/update', $data);
    }

    public static function deleteEmoji($id)
    {
        $data = ['id' => $id];

        return self::getFetcher()->call('post', 'api/v3/guild-emoji/delete', $data);
    }
}
