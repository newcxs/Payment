<?php namespace App\Http\Controllers;

class PayController extends Controller {
    public function __construct(){
        $this->middleware('guest');
    }
    public function getIndex($hash){
        $order = Order::findByHash($hash);
        if(!$order) return self::showMsg('订单不存在');
    }
}
