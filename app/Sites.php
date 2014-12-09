<?php

class Sites extends Eloquent {
    protected $table = 'sites';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['name', 'key', 'referrer', 'status'];

    static public function findByReferrer($referrer){
        return DB::table('sites')->where('referrer', $referrer)->first();
    }
}
