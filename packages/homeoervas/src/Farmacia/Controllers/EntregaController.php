<?php

namespace Pedroroccon\Farmacia\Controllers;

use Illuminate\Http\Request;
use Pedroroccon\Farmacia\Entrega;
use Pedroroccon\Farmacia\Requests\EntregaRequest;
use Pedroroccon\Farmacia\Filters\EntregaFilters;
use App\Http\Controllers\Controller;

class EntregaController extends Controller
{

    public function index(EntregaFilters $filters)
    {
        $entregas = Entrega::filter($filters)->ordenado()->paginate();
        return view('farmacia::farmacia.entrega.index', compact('entregas'));
    }

    public function create()
    {
        return view('farmacia::farmacia.entrega.create');
    }

    public function store(EntregaRequest $request)
    {
       $entrega = (new Entrega)->fill($request->all());
       $entrega->save();

       session()->flash('flash_success', 'Entrega para <a href="' . url($entrega->path()) . '">' . $entrega->cliente . '</a> adicionada com sucesso!');
       return back();
    }

    public function show(Entrega $entrega)
    {
        $itens = $entrega->itens;
        return view('farmacia::farmacia.entrega.show', compact('entrega', 'itens'));
    }

    public function edit(Entrega $entrega)
    {
        return view('farmacia::farmacia.entrega.edit', compact('entrega'));
    }

    public function destroy(Entrega $entrega)
    {
        $entrega->delete();
        session()->flash('flash_danger', 'Entrega para ' . $entrega->cliente . ' removida com sucesso!');
        return back();
    }

    public function imprimir(Request $request)
    {
        $entregas = explode(',', $request->entregas);

        // Atualiza as informações da entrega, informando que um item já foi impresso.
        Entrega::whereIn('id', $entregas)->update(['impresso_em' => now()]);
        
        $entregas = Entrega::whereIn('id', $entregas)->get();
        return view('farmacia::farmacia.entrega.impresso.entrega', compact('entregas'));
    }

    public function concluir(Request $request, Entrega $entrega)
    {
        $entrega->concluir($request->all());
        session()->flash('flash_success', 'Entrega para ' . $entrega->cliente . ' baixada com sucesso!');
        return back();
    }
}