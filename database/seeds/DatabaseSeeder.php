<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Model::unguard();
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'avatar' => "no-image.jpg",
            'password' => bcrypt('abc123'),
            'is_admin' => 1
        ]);
    }
}
