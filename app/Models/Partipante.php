<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partipante extends Model
{
    use HasFactory;
    protected $fillable =["evento_id","user_id"];

    public function user()
    {
        return $this->belongsTo(User::class);   
    }
    public function evento()
    {
        return $this->belongsTo(Evento::class);   
    }
}
