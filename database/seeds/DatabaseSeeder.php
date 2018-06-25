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
/*        \Illuminate\Database\Eloquent\Model::unguard();
        $this->call(UsersTableSeeder::class);
        \Illuminate\Database\Eloquent\Model::reguard();*/
        factory(App\User::class, 10)->create();
    }
}
