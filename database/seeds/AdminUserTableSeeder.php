<?php

use Illuminate\Database\Seeder;

class AdminUserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('admin_users')->insert(['name' => 'Kamran Hameed', 'email' => 'kamran.hameed@smartwareinc.com', 'password' => bcrypt('sw@123'), 'role' => 1]);
    }

}
