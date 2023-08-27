<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Evento::with("user")->get();
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
            "user_id"=>$request->input("user_id")
            
              
        ]);

     

        return $event;

    }

    public function show(Evento $evento)
    {
        return $evento;
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {

        //

       $evento->update($request->validate([
            "descricao" => ["nullable", "string"],
            "start_time" => ["sometimes", "date"],
            "end_time" => ["sometimes", "date", "after:start_time"],
            "nome" => ["sometimes", "string", "max:255"],
            "user_id"=>["sometimes","exists:users,id"]
        ]));

        return $evento;
     


       
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
