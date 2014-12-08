<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }
    static public function showMsg($msg, $url='javascript:history.go(-1);'){
        $this->load->view('msg', [
            'msg' => $msg,
            'url' => $url
        ]);
    }
    static public function loadModel($model){
        require __DIR__.'/../models/'.$model.'.php';
    }
    public function install(){
        $this->load->library('migration');
        $this->migration->version(1);
    }
}
