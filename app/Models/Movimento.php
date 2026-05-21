<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;
use Filament\Notifications\Notification;

class Movimento extends Model
{
    protected $fillable = [
        'produto_id', 'tipo_movimentacao', 'quantidade', 'data_movimentacao', 'observacao'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id');
    }
    
    
}