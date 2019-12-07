<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
class LoginController extends Controller
{
    public function adduser(){
        /*密码进行加密*/
        $pass='123456abc';
        $email='zhangsan@qq.com';
        $user_name=Str::random(8);

        /*使用密码函数进行加密*/
        $password=password_hash($pass,PASSWORD_BCRYPT);

        $data=[
            'user_name'=> $user_name,
            'password' => $password,
            'email' => $email,
        ];
        $uid = UserModel::insertGetId($data);
        var_dump($uid);
    }

    public function redis1(){
        $key='weixin';
        $val='hello world';
        Redis::set($key,$val);

        echo time();echo '</br>';
        echo date('Y-m-d H:i:s');
    }

    public function redis2(){
        $key='weixin';
        echo Redis::get($key);
    }
}
