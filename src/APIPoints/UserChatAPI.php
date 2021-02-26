<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/25 0025
 * Time: 11:59
 */

namespace KaiHeiLaSDK\APIPoints;


class UserChatAPI extends BaseEndPoint
{
    public static function getUserChatList()
    {
        return self::getFetcher()->call('get', 'api/v3/user-chat/index', []);
    }

    public static function getUserChatDetail($chat_code)
    {
        $data = ['chat_code' => $chat_code];

        return self::getFetcher()->call('get', 'api/v3/user-chat/view', $data);
    }

    public static function createUserChat($target_id)
    {
        $data = ['target_id' => $target_id];

        return self::getFetcher()->call('post', 'api/v3/user-chat/create', $data);
    }

    public static function deleteUserChat($chat_code)
    {
        $data = ['chat_code' => $chat_code];

        return self::getFetcher()->call('post', 'api/v3/user-chat/delete', $data);
    }
}
