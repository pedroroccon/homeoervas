<?php

namespace Pedroroccon\Farmacia\Controllers;

use Illuminate\Http\Request;
use Pedroroccon\Farmacia\Entrega;
use Pedroroccon\Farmacia\Filters\EntregaFilters;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class EntregaRelatorioController extends Controller
{

    public function index()
    {
        return view('farmacia::farmacia.entrega.relatorio.index');
    }

    public function fechamento(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('farmacia::farmacia.entrega.relatorio.fechamento.index');
        }

        $request->validate([
            'data' => 'required|date', 
            'ordenar' => 'required'
        ]);

        $inicio = Carbon::createFromFormat('Y-m-d', $request->data);
        $termino = Carbon::createFromFormat('Y-m-d', $request->data);

        if ($request->tipo == 'semanal') {
            $inicio = $inicio->startOfWeek();
            $termino = $termino->endOfWeek();
        }

        $entregas = Entrega::whereDate('impresso_em', '>=', $inicio)->whereDate('impresso_em', '<=', $termino)->get();
        $entregasRealizadas = $entregas->count();
        $entregasPagas = $entregas->whereNotNull('pago_em')->count();
        $entregasNaoPagas = $entregas->whereNull('pago_em')->count();

        $periodos = $entregas->groupBy('fechado_sequencial');
        return view('farmacia::farmacia.entrega.relatorio.fechamento.show', compact('periodos', 'entregasRealizadas', 'entregasPagas', 'entregasNaoPagas'));
    }

}