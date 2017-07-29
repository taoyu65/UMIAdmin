<?php

use Illuminate\Database\Seeder;
use YM\Commands\Traits\executeSeed;

class umiDatabaseSeeder extends Seeder
{
    use executeSeed;

    protected $seederPath;

    function __construct()
    {
        $this->seederPath = __DIR__ . '/';
    }

    public function run()
    {
        //$this->executeSeed('umi_menus_seeder');
        $this->executeSeed('umi_table_seeder');
        $this->executeSeed('umi_permissions_seeder');
        $this->executeSeed('umi_field_display_browser_seeder');
        $this->executeSeed('umi_field_display_read_seeder');
        $this->executeSeed('umi_field_display_add_seeder');
        $this->executeSeed('umi_field_display_edit_seeder');
        $this->executeSeed('umi_users_seeder');
        $this->executeSeed('ip_info_rate_seeder');
    }
}
