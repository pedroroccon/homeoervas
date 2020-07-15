<?php

namespace Pedroroccon\Farmacia\Controllers;

use Illuminate\Http\Request;
use Pedroroccon\Farmacia\Entrega;
use App\Http\Controllers\Controller;

class FarmaciaController extends Controller
{
    public function index()
    {
        $entregasHoje = Entrega::impressas()->hoje()->get();
        dd($entregasHoje);
        return view('farmacia::farmacia.index');
    }
}