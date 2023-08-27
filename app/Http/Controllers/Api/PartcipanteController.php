<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipanteResource;
use App\Models\Evento;
use App\Models\Partipante;
use Illuminate\Http\Request;
use Symfony\Contracts\EventDispatcher\Event;

class PartcipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Evento $evento)
    {
        $participante = $evento->participantes()->latest();

        //
        return ParticipanteResource::collection(

            $participante->with("user","evento")->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Evento $evento)
    {
        $request->validate([

            "user_id"=>"exists:users,id|required",
            "evento_id"=>"exists:eventos,id|required"
        ]);
        $participante = $evento->participantes()->create([
            "user_id"=>$request->user_id,
            "evento_id"=>$request->evento_id
        ]);

        return new ParticipanteResource($participante);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento,Partipante $participante)
    {
        //
        return new ParticipanteResource($participante);

    }

    
    public function destroy(string $evento,Partipante $participante)
    {
        //
        $participante->delete();
        return response(status:204);
    }
}
