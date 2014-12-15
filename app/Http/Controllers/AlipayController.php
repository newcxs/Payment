<?php namespace App\Http\Controllers;

class AlipayController extends Controller {
    public function __construct(){
        $this->middleware('guest');
        define('ALIPAY_PATH', __DIR__.'/../../Api/alipay/');
    }
    public function config(){
        return [
            'partner' => '', //合作身份者id
            'key' => '',     //安全检验码
            'sign_type' => strtoupper('MD5'),
            'input_charset'] => strtolower('utf-8'),
            'cacert' = ALIPAY_PATH.'cacert.pem',
            'transport' = 'http'
        ];
    }
    public function getSubmit($hash){
        $order = Order::findByHash($hash);
        if(!$order) return self::showMsg('Order not found');

        $alipay_config = $this->config();
        require_once ALIPAY_PATH."lib/alipay_submit.class.php";

        $payment_type = "1";
        $notify_url = URL::to('/alipay/notify');
        $return_url = URL::to('/alipay/return');
        $seller_email = 'payment@ishw.net';
        $out_trade_no = $order->id;
        $subject = 'Geekeye Recharge';
        $price = $order->cash;
        $quantity = "1";
        $logistics_fee = "0.00";
        $logistics_type = "EXPRESS";
        $logistics_payment = "SELLER_PAY";
        $body = 'Geekeye 充值';
        $show_url = 'http://www.geekeye.in';

        $receive_name = '';
        $receive_address = '';
        $receive_zip = '';
        $receive_phone = '';
        $receive_mobile = '';

        $parameter = [
            "service" => "trade_create_by_buyer",
            "partner" => trim($alipay_config['partner']),
            "payment_type"  => $payment_type,
            "notify_url"    => $notify_url,
            "return_url"    => $return_url,
            "seller_email"  => $seller_email,
            "out_trade_no"  => $out_trade_no,
            "subject"   => $subject,
            "price" => $price,
            "quantity"  => $quantity,
            "logistics_fee" => $logistics_fee,
            "logistics_type"    => $logistics_type,
            "logistics_payment" => $logistics_payment,
            "body"  => $body,
            "show_url"  => $show_url,
            "receive_name"  => $receive_name,
            "receive_address"   => $receive_address,
            "receive_zip"   => $receive_zip,
            "receive_phone" => $receive_phone,
            "receive_mobile"    => $receive_mobile,
            "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
        ];

        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "Confirm");
        return $html_text;
    }
    public function postNotify(){
        $alipay_config = $this->config();
        require_once ALIPAY_PATH."lib/alipay_notify.class.php";
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if($verify_result) {
            $out_trade_no = Input::get('out_trade_no'); //商户订单号
            $trade_no     = Input::get('trade_no');     //支付宝交易号
            $trade_status = Input::get('trade_status'); //交易状态

            if($trade_status == 'WAIT_BUYER_PAY') {
                //该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款

                echo "success";
            } else if($trade_status == 'WAIT_SELLER_SEND_GOODS') {
                //该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货

                echo "success";
            } else if($trade_status == 'WAIT_BUYER_CONFIRM_GOODS') {
                //该判断表示卖家已经发了货，但买家还没有做确认收货的操作

                echo "success";
            } else if($trade_status == 'TRADE_FINISHED') {
                //该判断表示买家已经确认收货，这笔交易完成

                $order_id = $out_trade_no;
                $order = Order::find($order_id);

                //callback***********************************

                $order->finish_time = time();
                $order->status = '1';
                $order->save();

                echo "success";
            } else {
                //其他状态判断

                echo "success";
            }
        } else {
            echo "fail";
        }
    }
    public function getReturn(){
        $alipay_config = $this->config();
        require_once ALIPAY_PATH."lib/alipay_notify.class.php";
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if($verify_result) {
            $out_trade_no = Input::get('out_trade_no'); //商户订单号
            $trade_no     = Input::get('trade_no');     //支付宝交易号
            $trade_status = Input::get('trade_status'); //交易状态

            if($trade_status == 'WAIT_SELLER_SEND_GOODS') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
            } else if($trade_status == 'TRADE_FINISHED') {
                //判断该笔订单是否在商户网站中已经做过处理
                    //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                    //如果有做过处理，不执行商户的业务程序
            } else {
                echo "trade_status=".$trade_status;
            }

            echo "验证成功<br />";
            echo "trade_no=".$trade_no;
        } else {
            echo "验证失败";
        }
    }
}
