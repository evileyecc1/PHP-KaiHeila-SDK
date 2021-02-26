<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/22 0022
 * Time: 10:03
 */

namespace KaiHeiLaSDK\APIPoints;


class GuildAPI extends BaseEndPoint
{
    public static function getList($page = 1,$page_list = 100)
    {
        $data = ['page' => $page,'page_list'=>$page_list];

        return self::getFetcher()->call('get', 'api/v3/guild/list', $data);
    }

    public static function getUserList($guild_id, array $options)
    {
        $data = array_merge(['guild_id' => $guild_id], $options);

        return self::getFetcher()->call('get', 'api/v3/guild/user-list', $data);
    }

    public static function modifyUserNickname($guild_id, $nickname = null, $user_id = null)
    {
        $data = ['guild_id' => $guild_id, 'nickname' => $nickname, '$user_id' => $user_id];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('post', 'api/v3/guild/nickname', $data);
    }

    public static function leaveServer($guild_id)
    {
        $data = ['guild_id' => $guild_id];

        return self::getFetcher()->call('post', 'api/v3/guild/leave', $data);
    }

    public static function kickoutUser($guild_id, $target_id)
    {
        $data = ['guild_id' => $guild_id, 'target_id' => $target_id];

        return self::getFetcher()->call('post', 'api/v3/guild/kickout', $data);
    }

    public static function getMuteList($guild_id)
    {
        $data = ['guild_id' => $guild_id];

        return self::getFetcher()->call('get', 'api/v3/guild-mute/list', $data);
    }

    public static function setMute($guild_id,$user_id,$type)
    {
        $data = ['guild_id' => $guild_id,'user_id' => $user_id,'type' => $type];

        return self::getFetcher()->call('post', 'api/v3/guild-mute/create', $data);
    }

    public static function unsetMute($guild_id,$user_id,$type)
    {
        $data = ['guild_id' => $guild_id,'user_id' => $user_id,'type' => $type];

        return self::getFetcher()->call('post', 'api/v3/guild-mute/delete', $data);
    }
}
