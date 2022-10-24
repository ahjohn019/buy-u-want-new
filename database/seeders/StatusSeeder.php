<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $createStatusOne = [
            'name' => 'active',
        ];

        $createStatusTwo = [
            'name' => 'hidden',
        ];

        DB::table('status')->insert([$createStatusOne,$createStatusTwo]);
    }
}
