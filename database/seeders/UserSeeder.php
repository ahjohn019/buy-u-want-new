<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Run the database seeders.
         *
         * @return void
         */

        // User::factory(5)->create();

        $create_user_one = [
            'name' => 'UserOne',
            'email' => 'yewrui@hotmail.com',
            'password' => Hash::make('123123123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        $create_user_two = [
            'name' => 'AdminOne',
            'email' => 'admin@hotmail.com',
            'password' => Hash::make('123123123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        $create_user_three = [
            'name' => 'AdminThree',
            'email' => 'admin2@hotmail.com',
            'password' => Hash::make('123123123'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        $create_user_one_details = [
            'gender' => 'male',
            'birth_date' => '30/6/1996',
            'role' => 'user',
            'home_number' => '0341614322',
            'mobile_number' => '0123771428',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        $create_user_two_details = [
            'gender' => 'male',
            'birth_date' => '30/6/1998',
            'role' => 'admin',
            'home_number' => '0341614322',
            'mobile_number' => '0123771428',
            'user_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        $create_user_two_addresses = [
            'address_line_one' => '332, Jalan E4',
            'address_line_two' => 'Taman Melawati',
            'postcode' => 53100,
            'city' => 'Wangsa Maju',
            'state' => 'Kuala Lumpur',
            'country' => 'Malaysia',
            'user_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        $create_user_two_addresses_two = [
            'address_line_one' => '311, Jalan E3',
            'address_line_two' => 'Taman Melawati',
            'postcode' => 53100,
            'city' => 'Rawang',
            'state' => 'Selangor',
            'country' => 'Malaysia',
            'user_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        $create_pivot_user_table = [
            [
                'user_id' => 1,
                'biography_id' => 1
            ],
            [
                'user_id' => 2,
                'biography_id' => 2
            ]
        ];
        // DB::table('user_biography')->insert($create_pivot_user_table);    
        
        DB::table('users')->insert([$create_user_one,$create_user_two, $create_user_three]);
        DB::table('biographies')->insert([$create_user_one_details, $create_user_two_details]);
        DB::table('addresses')->insert([$create_user_two_addresses, $create_user_two_addresses_two]);
        
        
        $user = Role::firstOrCreate(['name' => 'user']);
        $admin = Role::firstOrCreate(['name' => 'admin']);

        $db_user = User::where('id',1)->first(); 
        $db_admin = User::where('id',2)->first();
        $db_admin_two = User::where('id',3)->first();

        $db_user->assignRole($user);
        $db_admin->assignRole($admin);
        $db_admin_two->assignRole($admin);
    }
}
