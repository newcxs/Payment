<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require __DIR__.'/base.php';
class Paypal extends Base {
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->load->view('home');
    }
}
