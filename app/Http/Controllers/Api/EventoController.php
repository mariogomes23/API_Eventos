<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventoResource;
use App\Http\Resources\UserResource;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
        $this->middleware("auth:sanctum")->except(["index","show"]);
        $this->authorizeResource(Evento::class,"evento");
        
     }
    public function index()
    {
        //
        return EventoResource::collection(Evento::with("user")->get(),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


         $request->validate([
            "descricao" => ["nullable", "string"],
            "start_time" => ["required", "date"],
            "end_time" => ["required", "date", "after:start_time"],
            "nome" => ["required", "string", "max:255"],
            "user_id"=>["required","exists:users,id"]
        ]);


        $event = Evento::create([
            "nome"=>$request->nome,
            "descricao"=>$request->descricao,
            "end_time"=>$request->end_time,
            "start_time"=>$request->start_time,
            "user_id"=>$request->user()->id
            
              
        ]);

     

        return new EventoResource($event,200);

    }

    public function show(Evento $evento)
    {
        $evento->load("user","participantes");
        return new EventoResource($evento);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {

        //
       // if(Gate::denies("atualizar-evento",$evento))
        //{
          //  abort(403,"nao esta autorizado");
        //}

        Gate::authorize("atualizar-evento",$evento);


       $evento->update($request->validate([
            "descricao" => ["nullable", "string"],
            "start_time" => ["sometimes", "date"],
            "end_time" => ["sometimes", "date", "after:start_time"],
            "nome" => ["sometimes", "string", "max:255"],
            "user_id"=>["sometimes","exists:users,id"]
        ]));

        return new EventoResource($evento);
     


       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento  $evento)
    {
        $evento->delete();

        return response()->json([
            "message"=>"evento apagado"
        ]);
        //
    }
}
