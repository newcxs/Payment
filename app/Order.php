<?php

class Order extends Eloquent {
    protected $table = 'order';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'up_id', 'type', 'site_id', 'user_agent', 'callback_url', 'return_url', 'cash', 'hash', 'create_time', 'finish_time', 'status'];

    static public function findByHash($hash){
        return DB::table('order')->where('hash', $hash)->first();
    }
}
