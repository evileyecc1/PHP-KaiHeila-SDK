<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/25 0025
 * Time: 10:19
 */

namespace KaiHeiLaSDK\APIPoints;


class MessageAPI extends BaseEndPoint
{
    public static function getMessageList($target_id, $msg_id = null, $pin = null, $flag = null,$page = 1,$page_list = 100)
    {
        $data = ['target_id' => $target_id,'msg_id' => $msg_id,'pin' => $pin,'flag' => $flag,'page' => $page,'page_list'=>$page_list];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('get', 'api/v3/message/list', $data);
    }

    public static function sendMessage($target_id, $content, $type = null, $quote = null, $nonce = null, $temp_target_id = null)
    {
        $data = ['target_id' => $target_id,'content' => $content,'type' => $type,'quote' => $quote,'nonce'=>$nonce,'temp_target_id'=>$temp_target_id];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('post', 'api/v3/message/create', $data);
    }

    public static function updateMessage($target_id, $content, $quote = null)
    {
        $data = ['target_id' => $target_id,'content' => $content,'quote' => $quote];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('post', 'api/v3/message/update', $data);
    }

    public static function deleteMessage($msg_id)
    {
        $data = ['msg_id' => $msg_id,];

        return self::getFetcher()->call('post', 'api/v3/message/delete', $data);
    }

    public static function getReactionList($msg_id, $emoji)
    {
        $data = ['msg_id' => $msg_id,'emoji' => $emoji];

        return self::getFetcher()->call('post', 'api/v3/message/reaction-list', $data);
    }

    public static function addReaction($msg_id, $emoji)
    {
        $data = ['msg_id' => $msg_id,'emoji' => $emoji];

        return self::getFetcher()->call('post', 'api/v3/message/add-reaction', $data);
    }

    public static function removeReaction($msg_id, $emoji, $user_id = null)
    {
        $data = ['msg_id' => $msg_id,'emoji' => $emoji,'user_id'=>$user_id];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('post', 'api/v3/message/add-reaction', $data);
    }
}
