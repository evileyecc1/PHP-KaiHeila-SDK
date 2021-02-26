<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/25 0025
 * Time: 14:09
 */

namespace KaiHeiLaSDK\APIPoints;


class GuildRoleAPI extends BaseEndPoint
{
    public static function getRoleList($guild_id)
    {
        $data = ['guild_id' => $guild_id];

        return self::getFetcher()->call('get', 'api/v3/guild-role/index', $data);
    }

    public static function createRole($guild_id, $name = null)
    {
        $data = ['guild_id' => $guild_id, 'name' => $name];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('post', 'api/v3/guild-role/create', $data);
    }

    public static function updateRole($guild_id, $role_id, $hoist = null, $mentionable = null, $permissions = null, $color = null, $name = null)
    {
        $data = ['guild_id' => $guild_id, 'role_id' => $role_id, 'hoist' => $hoist, 'mentionable' => $mentionable, 'permissions' => $permissions, 'color' => $color,'name'=>$name];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('post', 'api/v3/guild-role/update', $data);
    }

    public static function deleteRole($guild_id, $role_id)
    {
        $data = ['guild_id' => $guild_id,'role_id'=>$role_id];

        return self::getFetcher()->call('post', 'api/v3/guild-role/delete', $data);
    }

    public static function grantRole($guild_id,$user_id,$role_id)
    {
        $data = ['guild_id' => $guild_id,'role_id'=>$role_id,'user_id'=>$user_id];

        return self::getFetcher()->call('post', 'api/v3/guild-role/grant', $data);
    }

    public static function revokeRole($guild_id,$user_id,$role_id)
    {
        $data = ['guild_id' => $guild_id,'role_id'=>$role_id,'user_id'=>$user_id];

        return self::getFetcher()->call('post', 'api/v3/guild-role/revoke', $data);
    }
}
