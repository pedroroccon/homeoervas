<?php

namespace Pedroroccon\Farmacia\Controllers;

use Illuminate\Http\Request;
use Pedroroccon\Farmacia\Entrega;
use Pedroroccon\Farmacia\Filters\EntregaFilters;
use App\Http\Controllers\Controller;

class EntregaRelatorioController extends Controller
{

    public function index()
    {
        return view('farmacia::farmacia.entrega.relatorio.index');
    }

    public function semanal(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'inicio' => 'required|date', 
                'termino' => 'required|date|after_or_equal:inicio', 
            ]);

            $entregas = Entrega::whereNotNull('impresso_em')->whereDate('impresso_em', '>=', $request->inicio)->whereDate('impresso_em', '<=', $request->termino)->orderBy($request->ordenar)->get();
            $entregasAgrupadas = $entregas->groupBy(function($key) {
                return $key->impresso_em->format('W');
            });

            return view('farmacia::farmacia.entrega.relatorio.semanal.show', compact('entregas', 'entregasAgrupadas', 'request'));
        }

        return view('farmacia::farmacia.entrega.relatorio.semanal.index');
    }

}