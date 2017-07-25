<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class umi_users_seeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            array(
                'id'        => 1,
                'name'      => 'admin',
                'email'     => 'taoyu65@gmail.com',
                'password'  => '$2y$10$qzxjNg7kODx6nVO8slOm8un955HPv9NrfqiSbKMDp/2iIokMV3gLi'
            )
        ]);
    }
}
