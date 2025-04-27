<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confeitaria extends Model
{
    protected $fillable = [
        'nome','telefone','cep','rua','numero','bairro','cidade','estado'
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
