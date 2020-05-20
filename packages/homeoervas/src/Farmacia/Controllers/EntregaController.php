<?php

namespace Pedroroccon\Farmacia\Controllers;

use Illuminate\Http\Request;
use Pedroroccon\Farmacia\Entrega;
use Pedroroccon\Farmacia\Requests\EntregaRequest;
use Pedroroccon\Farmacia\Filters\EntregaFilters;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class EntregaController extends Controller
{

    public function index(EntregaFilters $filters)
    {
        $entregasFeitasNaSemana = Entrega::impressas()->semana()->get();
        $entregasFeitasHoje = $entregasFeitasNaSemana->filter(function($key) {
            return $key->created_at->startOfDay()->eq(today()->startOfDay());
        });

        $entregasFeitasDeManha = $entregasFeitasHoje->filter(function($key) {
            return $key->impresso_em->hour <= 12;
        });

        $entregasFeitasDeTarde = $entregasFeitasHoje->filter(function($key) {
            return $key->impresso_em->hour > 13;
        });

        $entregas = Entrega::filter($filters)->ordenado()->paginate(120);
        return view('farmacia::farmacia.entrega.index', compact('entregas', 'entregasFeitasHoje', 'entregasFeitasDeManha', 'entregasFeitasDeTarde'));
    }

    public function create()
    {
        $view = request()->has('minimal') ? 'minimal' : 'create';
        return view('farmacia::farmacia.entrega.' . $view);
    }

    public function store(EntregaRequest $request)
    {
       $entrega = (new Entrega)->create($request->all(), $request->itens);

       session()->flash('flash_success', 'Entrega para <a href="' . url($entrega->path()) . '">' . $entrega->cliente . '</a> adicionada com sucesso!');
       return back();
    }

    public function show(Entrega $entrega)
    {
        $itens = $entrega->itens;
        return view('farmacia::farmacia.entrega.show', compact('entrega', 'itens'));
    }

    public function update(EntregaRequest $request, Entrega $entrega)
    {
        $entrega->fill($request->all());
        $entrega->update();

        session()->flash('flash_success', 'Entrega para <a href="' . url($entrega->path()) . '">' . $entrega->cliente . '</a> alterada com sucesso!');
        return back();
    }

    public function destroy(Entrega $entrega)
    {
        $entrega->delete();
        session()->flash('flash_danger', 'Entrega para ' . $entrega->cliente . ' removida com sucesso!');
        return back();
    }

    public function imprimir(Request $request)
    {
        $request->validate(['entregas' => 'required']);
        $entregas = explode(',', $request->entregas);

        // Atualiza as informações da entrega, informando que um item já foi impresso.
        Entrega::whereIn('id', $entregas)->update(['impresso_em' => now()]);
        
        $entregas = Entrega::whereIn('id', $entregas)->get();
        return view('farmacia::farmacia.entrega.impresso.entrega', compact('entregas'));
    }

    public function imprimirResumo(Request $request)
    {
        $request->validate(['entregas' => 'required']);
        $entregas = Entrega::whereIn('id', explode(',', $request->entregas))->get();
        return view('farmacia::farmacia.entrega.impresso.saida', compact('entregas'));
    }

    public function concluir(Request $request, Entrega $entrega)
    {
        $entrega->concluir($request->all());
        session()->flash('flash_success', 'Entrega para ' . $entrega->cliente . ' baixada com sucesso!');
        return back();
    }

    public function fechamento(Request $request)
    {
        if ($request->isMethod('get')) {
            $request->validate([
                'dia' => 'required|date', 
                'inicio_hora' => 'required|date_format:H:i', 
                'termino_hora' => 'required|date_format:H:i', 
            ]);

            $entregas = Entrega::fechamentosPendentes($request->dia . ' ' . $request->inicio_hora . ':00', $request->dia . ' ' . $request->termino_hora . ':00')->ordenado()->get();
            return view('farmacia::farmacia.entrega.fechamento', compact('entregas', 'request'));
        }

        try {
            Entrega::fecharPeriodo($request->inicio, $request->termino);
            session()->flash('flash_success', 'Período encerrado com sucesso!');
            return redirect(config('hello.url') . '/entrega/');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}