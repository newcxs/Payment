<?php

class Sites extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    
    public function findByReferrer($referrer){
        $query = $this->db->query("SELECT * FROM `".$this->table('sites')."` WHERE `referrer`='$referrer'");
        //$query = $this->db->select('sites', ['referrer' => $referrer]);
        return $query->result();
    }

}
