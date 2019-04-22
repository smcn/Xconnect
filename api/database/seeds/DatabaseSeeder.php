<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);		
		$this->command->info('User table seeded!');
		
		$this->call(ServicesTableSeeder::class);		
		$this->command->info('Service table seeded!');
    }
}

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert(
			[
				[
					'name' => 'admin',
					'email' => 'admin@omu.edu.tr',
					'password' => Hash::make('secret'),
					'tckimlikno' => null,
					'role' => 'admin',
				],
				[
					'name' => 'kps',
					'email' => 'kps@omu.edu.tr',
					'password' => Hash::make('secret'),
					'tckimlikno' => null,
					'role' => 'kps',
				],
				[
					'name' => 'yoksis',
					'email' => 'yoksis@omu.edu.tr',
					'password' => Hash::make('secret'),
					'tckimlikno' => null,
					'role' => 'yoksis',
				],
				[
					'name' => 'osym',
					'email' => 'osym@omu.edu.tr',
					'password' => Hash::make('secret'),
					'tckimlikno' => null,
					'role' => 'osym',
				],
				[
					'name' => 'detsis',
					'email' => 'detsis@omu.edu.tr',
					'password' => Hash::make('secret'),
					'tckimlikno' => null,
					'role' => 'detsis',
				],
			]
		);
    }

}

class ServicesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('services')->delete();

        DB::table('services')->insert(
			[
				[
					'name' => 'kps',
					'account' => '',
					'password' => '',
					'account2' => null,
					'password2' => null,
					'description' => 'mernis web servisleri',
				],
				[
					'name' => 'yoksis',
					'account' => '',
					'password' => '',
					'account2' => '',
					'password2' => '',
					'description' => 'yöksis web servisleri',
				],
				[
					'name' => 'osym',
					'account' => '',
					'password' => '',
					'account2' => null,
					'password2' => null,
					'description' => 'ösym web servisleri',
				],
				[
					'name' => 'detsis',
					'account' => '',
					'password' => '',
					'account2' => null,
					'password2' => null,
					'description' => 'detsis web servisleri',
				],
			]
		);
    }

}
