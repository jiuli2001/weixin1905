<?php

namespace App\Http\Controllers\Wx;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeixinController extends Controller
{
    public function weixin(){
    	echo "1905微信开发";
    }

    public function  index(Request $request)
    {
        echo $request->echostr;
    }
    public function wechat()
    {
        $token = 'echostr';       //开发提前设置好的 token
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $echostr = $_GET["echostr"];

        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){        //验证通过
            echo $echostr;
        }else{
            die("not ok");
        }
    }

    public function receiv(){
        $log_file = "wx.log";
        $xml=file_get_contents("php://input");
        $data =date('Y-m-d H:i:s '). $xml;
        file_put_contents($log_file,$data,FILE_APPEND);
    }
    public function getUserInfo(){
        $url='ttps://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN';
    }
}
