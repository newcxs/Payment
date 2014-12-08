<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sites extends Illuminate\Database\Eloquent\Model {
    protected $table = 'sites';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['name', 'key', 'referrer', 'status'];

    static public function findByReferrer($referrer){
        return Illuminate\Database\Eloquent\DB::table('sites')->where('referrer', $referrer)->first();
    }
}
