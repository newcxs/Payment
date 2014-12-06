<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_database extends CI_Migration {
    public function up(){
        $this->createSites();
        $this->createOrder();
    }

    public function createOrder(){
        $this->dbforge->add_field([
            'id' => [
                'type' => 'int',
                'constraint' => 16,
                'auto_increment' => true
            ],
            'up_id' => [
                'type' => 'varchar',
                'constraint' => '64'
            ],
            'type' => [
                'type' => 'varchar',
                'constraint' => '16'
            ],
            'site_id' => [
                'type' => 'varchar',
                'constraint' => '16'
            ],
            'user_agent' => [
                'type' => 'varchar',
                'constraint' => '128'
            ],
            'callback_url' => [
                'type' => 'text'
            ],
            'return_url' => [
                'type' => 'text'
            ],
            'cash' => [
                'type' => 'varchar',
                'constraint' => '16'
            ],
            'hash' => [
                'type' => 'varchar',
                'constraint' => '32'
            ],
            'status' => [
                'type' => 'varchar',
                'constraint' => '2'
            ]
        ]);
        
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('order');
    }

    public function createSites(){
        $this->dbforge->add_field([
            'id' => [
                'type' => 'int',
                'constraint' => 16,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => '64'
            ],
            'key' => [
                'type' => 'varchar',
                'constraint' => '32'
            ],
            'referrer' => [
                'type' => 'varchar',
                'constraint' => '64'
            ],
            'status' => [
                'type' => 'varchar',
                'constraint' => '2'
            ]
        ]);
        
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('sites');
    }

    public function down(){
        $this->dbforge->drop_table('order');
        $this->dbforge->drop_table('sites');
    }
}
