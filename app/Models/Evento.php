<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = ["nome","descricao","start_time","end_time","user_id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participantes():HasMany
    {
        return $this->hasMany(Partipante::class);
    }

    
}
