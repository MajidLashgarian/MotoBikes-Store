<?php

use Illuminate\Database\Seeder;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->delete();

        \App\User::create(['email' => 'admin@admin.com' , 'password'=>'admin' , 'permission'=>1]); //permission 1 means it has full permission

    }
}
