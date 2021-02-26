<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/25 0025
 * Time: 14:12
 */

namespace KaiHeiLaSDK\Utils;


class PermissionUtil
{
    public static function hasPermission($permissions, $permission)
    {
        $bitValue = substr_count(decbin($permission),0);

        return $permission == 1 || ($permissions & (1 << $bitValue)) == (1 << $bitValue);
    }
}
