<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require __DIR__.'/base.php';
class Alipay extends Base {
    public function __construct(){
        parent::__construct();
        define('ALIDIR', __DIR__.'/../libraries/alipay/');
    }
    private function config(){
        return [
            'partner' => '', //合作身份者id
            'key' => '',     //安全检验码
            'input_charset' => strtolower('utf-8'),
            'cacert' => ALIDIR.'cacert.pem',
            'transport' => 'http',
        ];
    }
    public function to(){
        $orderId = $this->input->get('orderId');
        $orderModel = $this->load->model('order');
        $alipay_config = $this->config();
        require_once ALIDIR."lib/alipay_submit.class.php";

        $payment_type      = "1";
        $notify_url        = $this->config->item('base_url')."alipay/notify";
        $return_url        = $this->config->item('base_url')."alipay/return";
        $seller_email      = $_POST['WIDseller_email']; //卖家支付宝帐户
        $out_trade_no      = $_POST['WIDout_trade_no']; //商户订单号      
        $subject           = $_POST['WIDsubject'];      //订单名称
        $total_fee         = $_POST['WIDtotal_fee'];    //付款金额
        $body              = $_POST['WIDbody'];         //订单描述
        $show_url          = $_POST['WIDshow_url'];     //商品展示地址   
        $anti_phishing_key = "";                        //防钓鱼时间戳   
        $exter_invoke_ip   = "";                        //客户端的IP地址

        $parameter = [
            "service"           => "create_direct_pay_by_user",
            "partner"           => trim($alipay_config['partner']),
            "payment_type"      => $payment_type,
            "notify_url"        => $notify_url,
            "return_url"        => $return_url,
            "seller_email"      => $seller_email,
            "out_trade_no"      => $out_trade_no,
            "subject"           => $subject,
            "total_fee"         => $total_fee,
            "body"              => $body,
            "show_url"          => $show_url,
            "anti_phishing_key" => $anti_phishing_key,
            "exter_invoke_ip"   => $exter_invoke_ip,
            "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
        ];

        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "确认");
        echo $html_text;
    }

    public function notify(){
        $alipay_config = $this->config();
        require_once ALIDIR."lib/alipay_notify.class.php";
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if($verify_result) {
            $out_trade_no = $_POST['out_trade_no'];   //商户订单号
            $trade_no     = $_POST['trade_no'];       //支付宝交易号
            $trade_status = $_POST['trade_status'];   //交易状态
            if($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS') {
                //交易完成 or 支付成功
            }
            echo "success";
        } else {
            echo "fail";
        }
    }
    public function return(){
        $alipay_config = $this->config();
        require_once ALIDIR."lib/alipay_notify.class.php";
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {
            $out_trade_no = $_GET['out_trade_no'];//商户订单号
            $trade_no = $_GET['trade_no'];//支付宝交易号
            $trade_status = $_GET['trade_status'];//交易状态

            if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                //notify 已经处理，return 无需处理
                $msg = "支付成功！";
            } else {
                $msg = "支付状态 [".$_GET['trade_status']."] 错误，请联系管理员！";
            }
            
            Base::showMsg($msg, $this->config->item('base_url'));
        } else {
            Base::showMsg("支付失败！");
        }
    }
}
