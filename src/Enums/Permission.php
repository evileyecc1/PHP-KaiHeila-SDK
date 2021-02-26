<?php
/**
 * Created by PhpStorm.
 * User: ChenJiaying
 * Date: 2021/2/25 0025
 * Time: 14:11
 */

namespace KaiHeiLaSDK\Enums;


class Permission
{
    public const Admin = 1;
    public const ManageServer = 2;
    public const ViewManageLog = 4;
    public const CreateInvite = 8;
    public const ManageInvite = 16;
    public const ManageChannel = 32;
    public const KickUser = 64;
    public const BanUser = 128;
    public const ManageEmoji = 256;
    public const EditNickname = 512;
    public const ManageRole = 1024;
    public const ChannelAccess = 2048;
    public const SendMessage = 4096;
    public const ManageMessage = 8192;
    public const UploadFile = 16384;
    public const JoinVoiceChannel = 32768;
    public const ManageVoiceChannel = 65536;
    public const MentionAll = 131072;
    public const AddReaction = 262144;
    public const FollowReaction = 524288;
    public const PassiveJoinVoiceChannel = 1048576;
    public const OnlyUsePushToTalk = 2097152;
    public const FreeTalk = 4194304;
    public const Talk = 8388608;
    public const Mute = 16777216;
    public const MicMute = 33554432;
    public const EditOthersNickname = 67108864;
    public const PlayBGM = 134217728;

}
