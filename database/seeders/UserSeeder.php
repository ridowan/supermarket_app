<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
			[
			'fullname' => 'Ridowan',
			'email' => 'ridowann@gmail.com',
			'password' => Hash::make('password'),
			'role'	=> 'Supervisor'
			],[
			'fullname' => 'Staff',
			'email' => 'staff@gmail.com',
			'password' => Hash::make('password'),
			'role'	=> 'Staff'
			],[
			'fullname' => 'Cashier',
			'email' => 'cashier@gmail.com',
			'password' => Hash::make('password'),
			'role'	=> 'Cashier'
			]
		]);
	}
}
