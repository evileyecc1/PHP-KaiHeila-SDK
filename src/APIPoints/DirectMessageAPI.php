<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/25 0025
 * Time: 13:55
 */

namespace KaiHeiLaSDK\APIPoints;


class DirectMessageAPI extends BaseEndPoint
{
    public static function getMessageList($chat_code,$target_id = null, $msg_id = null, $flag = null,$page = 1,$page_list = 100)
    {
        $data = ['chat_code'=>$chat_code, 'target_id' => $target_id,'msg_id' => $msg_id,'flag' => $flag,'page' => $page,'page_list'=>$page_list];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('get', 'api/v3/direct-message/list', $data);
    }

    public static function sendMessage($chat_code, $content, $type = null, $quote = null, $nonce = null, $target_id = null)
    {
        $data = ['target_id' => $target_id,'content' => $content,'type' => $type,'quote' => $quote,'nonce'=>$nonce,'chat_code'=>$chat_code];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('post', 'api/v3/direct-message/create', $data);
    }

    public static function updateMessage($target_id, $content, $quote = null)
    {
        $data = ['target_id' => $target_id,'content' => $content,'quote' => $quote];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('post', 'api/v3/direct-message/update', $data);
    }

    public static function deleteMessage($msg_id)
    {
        $data = ['msg_id' => $msg_id,];

        return self::getFetcher()->call('post', 'api/v3/direct-message/delete', $data);
    }

    public static function getReactionList($msg_id, $emoji)
    {
        $data = ['msg_id' => $msg_id,'emoji' => $emoji];

        return self::getFetcher()->call('post', 'api/v3/direct-message/reaction-list', $data);
    }

    public static function addReaction($msg_id, $emoji)
    {
        $data = ['msg_id' => $msg_id,'emoji' => $emoji];

        return self::getFetcher()->call('post', 'api/v3/direct-message/add-reaction', $data);
    }

    public static function removeReaction($msg_id, $emoji, $user_id = null)
    {
        $data = ['msg_id' => $msg_id,'emoji' => $emoji,'user_id'=>$user_id];
        $data = self::cleanRequestData($data);

        return self::getFetcher()->call('post', 'api/v3/direct-message/add-reaction', $data);
    }
}
