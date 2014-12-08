<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $this->call('SitesTableSeeder');
        $this->command->info('Sites table seeded!');
    }

}

class SitesTableSeeder extends Seeder {

    public function run(){
        DB::table('sites')->delete();
        DB::table('sites')->insert([
            'name' => 'Time Machine',
            'key' => md5('timemachine'),
            'referrer' => 'http://tm.geekeye.in',
            'status' => '1'
        ]);
    }

}
