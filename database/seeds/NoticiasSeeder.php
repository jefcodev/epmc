<?php

use Illuminate\Database\Seeder;

use App\Noticia;

class NoticiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Noticia::class,20)->create([]);
    }
}
