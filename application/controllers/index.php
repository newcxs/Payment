<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require __DIR__.'/base.php';
class Index extends Base {
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        self::loadModel('Sites');
        $test = Sites::findByReferrer('123');
        print_r($test);
        //$this->load->view('home');
    }
}
