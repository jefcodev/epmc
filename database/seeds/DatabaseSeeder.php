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
        $this->call(UsersSeeder::class);
        $this->call(GeneralesSeeder::class);
        $this->call(NoticiasSeeder::class);
        $this->call(FormulariosSeeder::class);
        $this->call(ConsultasSeeder::class);
        $this->call(RequisitosSeeder::class);

    }
}
