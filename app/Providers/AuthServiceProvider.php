<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Evento;
use App\Models\Partipante;
use App\Policies\EventoPolicy;
use App\Policies\ParticipantePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //

        Evento::class => EventoPolicy::class,
        Partipante::class => ParticipantePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //

        //Gate::define("atualizar-evento",function($user ,Evento $evento){

          //  return $user->id === $evento->user_id;
        //});


        //Gate::define("apagar-participante",function($user,Evento $evento,Partipante $partipante)
        //{
          // return $user->id === $evento->user_id || $user->id === $partipante->user_id;
               
       // });
    }
}
