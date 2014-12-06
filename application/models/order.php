<?php

class Order extends CI_Model {
    public function __construct(){
        parent::__construct();
    }
    
    public function get_last_ten_entries(){
        $query = $this->db->get('entries', 10);
        return $query->result();
    }

    public function insert_entry(){
        $this->title   = $_POST['title']; // 请阅读下方的备注
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('entries', $this);
    }

    public function update_entry(){
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }

}