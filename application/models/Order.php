<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends Illuminate\Database\Eloquent\Model {
    protected $table = 'order';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['up_id', 'type', 'site_id', 'user_agent', 'callback_url', 'return_url', 'cash', 'hash', 'status'];

}
