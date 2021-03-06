<?php
namespace app\login\model;
use common\custom\TerminalInfo;
use think\Model;
use think\Request;
/**
 * 登录用户模型
 */
class LoginLog extends Model {

    protected $resultSetType = 'collection';
    const type_WEB = 0;  //登录类型

    public static function  addLog($Data,$state)
    {
        //获取终端
        $TerminalInfo =  new TerminalInfo();
        //验证类
        $request = Request::instance();
        $ip = $request->ip();//ip
        $Self = new static();
        $Self->uid     = $Data['id'];//用户id
        $Self->type    = self::type_WEB;//登录类型
        $Self->state     = $state;//登录状态 0成功 1失败
        $Self->info    = $Data['info'];//详细信息
        $Self->ip     = $ip;//登录ip
        $Self->machine    = $TerminalInfo -> getArowserInfo('json');//登录的设备
        $Self->status     = 0;//状态，0为正常，1为锁定
        $Self->isdel    = 0; //软删除
        $Self->create_time    = date('Y-m-d H:i:s'); //登录时间
        $Self->save();
    }
}
