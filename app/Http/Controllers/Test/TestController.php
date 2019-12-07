<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TestController extends Controller
{
	public function hello(){
		echo "你好，九黎1905 aaa";
	}

	public function baidu(){
	    $url ='https://theory.gmw.cn/2019-12/05/content_33377331.htm';
	    $client=new Client();
	    $response=$client->request('GET',$url);
	    echo $response->getBody();
    }
}
