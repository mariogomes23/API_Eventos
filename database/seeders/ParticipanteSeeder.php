<?php

namespace Database\Seeders;

use App\Models\Evento;
use App\Models\Partipante;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = User::all();
        $eventos = Evento::all();
        foreach($users as $user)
        {
        $eventoParticipante = $eventos->random(rand(1,3));
          
        foreach($eventoParticipante as $event)
        {
            Partipante::create([

                "user_id"=>$user->id,
                "evento_id"=>$event->id
            ]);
        }

        }
    }
}
