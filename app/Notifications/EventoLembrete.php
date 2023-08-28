<?php

namespace App\Notifications;

use App\Models\Evento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventoLembrete extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Evento $evento)
    {

        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Lembrete:evento')
                    ->action('visualizar evento', route('eventos.show',$this->evento->id))
                    ->line('
                    
                    O evento {$this->evento->nome} inicia em {$this->evento->start_time}
                    ');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
            "evento_id"=>$this->evento->id,
            "evento_nome"=>$this->evento->nome,
            "evento_start_time"=>$this->evento->start_time
        ];
    }
}
