<?php namespace App\Http\Controllers;

class ApiController extends Controller {
    public function __construct(){
        $this->middleware('guest');
    }
    static public function buildRes($code, $msg = "Access Denied", $data = []){
        return json_encode([
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ]);
    }
    
    public function postEstablish(){
        $referrer = $_SERVER['HTTP_REFERRER'];
        if(!$referrer) return self::buildRes('-1');
        $receive = [
            'hash' => Input::get('hash'),
            'data' => Input::get('data')
        ];
        $site = Sites::findByReferrer($referrer);
        if(!$site) return self::buildRes('-1');
        $newHash = md5($receive['data'].$site->key);
        if($newHash != $receive['hash']) return self::buildRes('-1');

        $data = json_decode($receive['data'], true);
        $payment = $data['type'];
        if(!in_array($payment, ['alipay', 'paypal'])) return self::buildRes('-1');
        switch($payment){
            case 'alipay':
                $payment = '01';
                break;
            case 'paypal':
                $payment = '02';
                break;
            default:
                $payment = '00';
                break;
        }

        if($payment != '01') return buildRes('-1', 'Payment not supported');

        $order_id = date("YmdHis").$payment.rand(1000, 9999);
        $hash = md5($order_id.$newHash);

        $order = new Order;
        $order->id = $order_id;
        $order->up_id = '';
        $order->type = $data['type'];
        $order->site_id = $site->id;
        $order->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $order->callback_url = $data['callback'];
        $order->return_url = $data['return'];
        $order->cash = $data['cash'];
        $order->hash = $hash;
        $order->create_time = time();
        $order->finish_time = '0';
        $order->status = '0';
        $order->save();

        return buildRes('1', 'success', [
            'order_id' => $order_id,
            'hash' => $hash,
            'pay_url' => URL::to('/'.$data['type'].'/submit/'.$hash)
        ]);
    }
}
