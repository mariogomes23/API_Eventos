<?php

namespace App\Console\Commands;

use App\Models\Evento;
use App\Notifications\EventoLembrete;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
class EnvioEventoLembrete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:envio-evento-lembrete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'envio de lembretes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $eventos = Evento::with("participantes.user")
        ->whereBetween("start_time",[now(),now()->addDay(2)])
        ->get();

        $eventocount=$eventos->count();
        $eventLabel = Str::plural("evento",$eventocount);

        $this->info("FOund {$eventocount} {$eventLabel}.");
        $eventos->each(fn($evento)=>$evento->participantes()->each(fn($participante)=>$participante->user->notify(
            new EventoLembrete($evento)
        )));
        $this->info("lembrar notificacoes enviadas");
    }
}
