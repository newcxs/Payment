<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }
    public function establish(){
        $referrer = $_SERVER['HTTP_REFERER'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        echo $user_agent."\n".$referrer;
    }
}
