<?php

use Illuminate\Database\Seeder;

class SysLanguageMasterDetailsSeederInitial extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/seeds/raw/sys_language_master_details.sql';
        DB::unprepared(file_get_contents($path));
    }
}
