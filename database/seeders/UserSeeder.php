<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::Create([
            'name' => 'Admin',
            'email' => 'support@aisent.net',
            'password' => bcrypt('suppoer123'),
        ]);
        $user->save();
    }
}
