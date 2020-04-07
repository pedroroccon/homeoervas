<?php

namespace Pedroroccon\Farmacia\Controllers;

use Illuminate\Http\Request;
use Pedroroccon\Farmacia\Entrega;
use Pedroroccon\Farmacia\EntregaItem;
use App\Http\Controllers\Controller;

class EntregaItemController extends Controller
{
    public function store(Request $request, Entrega $entrega)
    {
        $item = (new EntregaItem)->fill($request->all());
        $entrega->itens()->save($item);
        session()->flash('flash_success', 'Item ' . $item->titulo . ' adicionado com sucesso na entrega para <a href="' . url($entrega->path()) . '">' . $entrega->cliente . '</a>');
    }

    public function destroy(Entrega $entrega, EntregaItem $item)
    {
        $item->delete();
        session()->flash('flash_danger', 'Item ' . $item->titulo . ' removido da entrega para <a href="' . url($entrega->path()) . '">' . $entrega->cliente . '</a>');
        return back();
    }
}