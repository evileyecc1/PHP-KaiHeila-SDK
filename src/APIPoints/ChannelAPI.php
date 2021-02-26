<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/22 0022
 * Time: 15:39
 */

namespace KaiHeiLaSDK\APIPoints;


class ChannelAPI extends BaseEndPoint
{
    public static function getRoles($channel_id)
    {
        $data = ['channel_id' => $channel_id];

        return self::getFetcher()->call('get', 'api/v3/channel-role/index', $data);
    }

    public static function createRolePermission($channel_id,$type = 'role_id',$value = null)
    {
        $data = ['channel_id' => $channel_id,'type' => $type,'value' => $value];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('post', 'api/v3/channel-role/create', $data);
    }

    public static function updateRolePermission($channel_id,$type = 'role_id',$value = null,$allow = 0,$deny = 0)
    {
        $data = ['channel_id' => $channel_id,'type' => $type,'value' => $value,'allow'=>$allow,'deny'=>$deny];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('post', 'api/v3/channel-role/update', $data);
    }

    public static function deleteRole($channel_id,$type = 'role_id',$value = null)
    {
        $data = ['channel_id' => $channel_id,'type' => $type,'value' => $value];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('post', 'api/v3/channel-role/delete', $data);
    }
}
