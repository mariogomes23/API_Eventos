<?php

namespace Database\Seeders;

use App\Models\Evento;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $users = User::all();
        for($i=0;$i<100;$i++)
        {
            $user = $users->random();
            Evento::factory()->create([

                "user_id"=>$user->id
            ]);
        }
    }
}
