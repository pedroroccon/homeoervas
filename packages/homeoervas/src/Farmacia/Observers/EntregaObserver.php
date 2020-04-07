<?php

namespace Pedroroccon\Farmacia\Observers;

use Pedroroccon\Farmacia\Entrega;
use Pedroroccon\Farmacia\EntregaItem;

class EntregaObserver
{
    public function created(Entrega $entrega)
    {
        $entrega->gerarNumero();
    
        if (request()->has('itens')) {
            foreach(request('itens') as $item) {
                $entrega->itens()->save(new EntregaItem([
                    'titulo' => $item['titulo'], 
                    'quantidade' => $item['quantidade'],
                    'homeopatia' => $item['homeopatia'],  
                    'geladeira' => $item['geladeira'], 
                    'pedido' => $item['pedido']
                ]));
            }
        }
    }
}