<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParticipanteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

          
            'id' => $this->id,
           
            'user' => new UserResource($this->whenLoaded('user')), // Recurso aninhado para o usuário
            'evento' => new EventoResource($this->whenLoaded('evento')), // Recurso aninhado para o evento

        ];
    }
}
