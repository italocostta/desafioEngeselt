<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'confeitaria_id','nome','valor','descricao'
    ];

    public function confeitaria()
    {
        return $this->belongsTo(Confeitaria::class);
    }

    public function imagens()
    {
        return $this->hasMany(ProdutoImagem::class);
    }
}
