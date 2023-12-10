<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Jaime Santana";
        $user->email = "sistemas@santana.ec";
        $user->password = bcrypt('santana90');
        $user->save();
        
    }
}
