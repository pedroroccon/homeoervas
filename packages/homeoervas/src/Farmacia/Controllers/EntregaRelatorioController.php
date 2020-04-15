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

}