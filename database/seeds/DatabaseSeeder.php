<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(umi_menus_seeder::class);
//        $this->call(umi_table_seeder::class);
//        $this->call(umi_permissions_seeder::class);
//        $this->call(umi_field_display_browser_seeder::class);
        $this->call(umi_field_display_read_seeder::class);
    }
}
