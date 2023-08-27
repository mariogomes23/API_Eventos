<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            "id"=>$this->id,
            "nome"=>$this->nome,
            "start_time"=>$this->start_time,
            "end_time"=>$this->end_time,
            "descricao"=>$this->descricao,
            "user"=>new UserResource($this->whenLoaded("user")),
            "participantes"=>ParticipanteResource::collection($this->whenLoaded("participantes")) 

        ];
    }
}
