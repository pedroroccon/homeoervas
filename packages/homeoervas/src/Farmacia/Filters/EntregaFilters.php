<?php

namespace Pedroroccon\Farmacia\Filters;

use Pedroroccon\Hello\Filters\Filters;

class EntregaFilters extends Filters
{
    /**
     * List of all avaliable filters.
     *
     * @var array
     */
    protected $filters = [
        'keyword',
        'auto',
        'cliente', 
        'endereco', 
        'cidade', 
        'estado', 
        'responsavel', 
        'semana', 
        'status', 
    ];

    protected function keyword($keyword)
    {
        $campo = $this->request->campo;
        $this->$campo($keyword);
    }

    protected function auto($auto)
    {
        return $this->builder->where('cliente', 'like', '%' . $cliente . '%');
    }

    protected function cliente($cliente)
    {
        return $this->builder->where('cliente', 'like', '%' . $cliente . '%');
    }

    protected function endereco($endereco)
    {
        return $this->builder->where('endereco', 'like', '%' . $endereco . '%');
    }

    protected function cidade($cidade)
    {
        return $this->builder->where('cidade', 'like', '%' . $cidade . '%');
    }

    protected function estado($estado)
    {
        return $this->builder->where('estado', 'like', '%' . $estado . '%');
    }

    protected function responsavel($responsavel)
    {
        return $this->builder->where('responsavel', 'like', '%' . $responsavel . '%');
    }

    protected function semana($semana)
    {
        return $semana ? $this->builder->whereDate('created_at', '>=', today()->startOfWeek())->whereDate('created_at', '<=', today()->endOfWeek()) : null;
    }

    protected function status($status)
    {
        $disponives = ['pendentes', 'comSaldo', 'pagas'];
        return in_array($status, $disponives) ? $this->builder->$status() : false;
    }
}