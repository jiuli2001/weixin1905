<?php

namespace App\Http\Controllers\Wx;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeixinController extends Controller
{
    protected $access_token;

    public function __construct()
    {
        //获取sccess_token
        $this->access_token = $this->GetAccessToken();
    }

    public function GetAccessToken(){
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WX_APPID').'&secret='.env('WX_APPSECREET');
        $data_json = file_get_contents($url);
        $arr = json_decode($data_json,true);
        return $arr['access_token'];
    }

    //接入微信
    public function wx(){
        $token='2259b56f5898cd6192c50d338723d9e4';
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $echostr=$_GET['echostr'];

        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );


        if($tmpStr == $signature){
            echo $echostr;
        }else{
            die('not ok');
        }

    }

    /*
   * 接收微信推送事件
   */
    public function receiv(){
        $log_file = 'wx.log';
        $xml_str = file_get_contents("php://input");
        //将接收的数据记录到日志文件
        $data = date('Y-m-d H:i:s').$xml_str;
        file_put_contents($log_file,$data,FILE_APPEND);         //追加写

        //处理xml数据
        $xml_obj = simplexml_load_string($xml_str);

        $event = $xml_obj->Event;  //获取事件7类型 是不是关注
        if($event=='subscribe'){
            $oppenid = $xml_obj->FromUserName;      //获取用户的oppenid

            //获取用户信息
            $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->access_token.'&openid='.$oppenid.'&lang=zh_CN';
            $user_info = file_get_contents($url);
            file_put_contents('wx.user.log',$user_info,FILE_APPEND);
        }
        $msg_type=$xml_obj->MsgType;

        $touser=$xml_obj->FromUserName;  //接受用户的oppenid
        $fromuser=$xml_obj->ToUserName;   //开发者公众号的id
        $time=time();
        if($msg_type=='text'){
            $content = date('Y-m-d H:i:s')."   ".$xml_obj->Content;
            $response_text = '<xml>
  <ToUserName><![CDATA['.$touser.']]></ToUserName>
  <FromUserName><![CDATA['.$fromuser.']]></FromUserName>
  <CreateTime>'.$time.'</CreateTime>
  <MsgType><![CDATA[text]]></MsgType>
  <Content><![CDATA['.$content.']]></Content>
</xml>';
            echo $response_text;            // 回复用户消息
        }

    }

    /**
     *获取用户基本信息
     */
    public function getUserInfo($access_token,$oppenid){
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$oppenid.'&lang=zh_CN';
        //发送网络请求
        $json_str = file_get_contents($url);
        $log_file = 'wx.user.log';
        file_put_contents($log_file,$json_str,FILE_APPEND);
    }



}
