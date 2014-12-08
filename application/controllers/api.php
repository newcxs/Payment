<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require __DIR__.'/base.php';
class Api extends Base {
    public function __construct(){
        parent::__construct();
    }
    public function establish(){
        $referrer = $_SERVER['HTTP_REFERER'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        self::loadModel('Sites');
    }
    public function callback(){}
}
