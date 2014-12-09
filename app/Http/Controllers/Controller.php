<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use ValidatesRequests;

    static public function showMsg($msg, $url='javascript:history.go(-1);'){
        return view('msg')
                    ->withMsg($msg)
                    ->withUrl($url);
    }

}
