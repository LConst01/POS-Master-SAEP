<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome', 'categoria', 'marca', 'codigo_barras', 'cor', 'material', 'compatibilidade', 'preco', 'quantidade_atual', 'estoque_minimo', 'garantia_estendida', 'descricao', 'status'
    ];
}
