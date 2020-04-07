<?php

namespace Pedroroccon\Farmacia;

use Illuminate\Database\Eloquent\Model as Model;

class EntregaItem extends Model
{

    protected $table = 'entrega_itens';

    protected $fillable = [
        'titulo', 
        'quantidade', 
        'homeopatia', 
        'geladeira', 
        'pedido', 
    ];

    public function entrega()
    {
        return $this->belongsTo(Entrega::class);
    }

    public function path()
    {
        return $this->entrega->path() . '/item/' . $this->id;
    }


}