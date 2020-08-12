<?php

namespace Pedroroccon\Farmacia;

use Illuminate\Database\Eloquent\Model as Model;
use Carbon\Carbon;

class Entrega extends Model
{
    protected $fillable = [
        'cliente', 
        'telefone', 
        'pedido', 
        'endereco', 
        'numero', 
        'bairro', 
        'cidade', 
        'estado', 
        'cep', 
        'valor', 
        'valor_pago', 
        'valor_retornado', 
        'troco', 
        'envio', 
        'envio_em', 
        'observacao', 
        'responsavel', 
    ];

    /**
     * Define os campos do modelo 
     * que devem ser tratados 
     * como datas.
     * 
     * @var array
     */
    protected $dates = [
        'pago_em', 
        'envio_em', 
        'fechado_em', 
        'impresso_em', 
    ];

    /**
     * Retorna o status do
     * recurso atual
     *
     * @var object
     */
    public $status;

    /**
     * Define as formas de pagamento 
     * disponíveis para as entregas.
     * 
     * @var array
     */
    public static $forma_pagamento_list = [
        'Cartão de crédito' => 'Cartão de crédito', 
        'Cartão de débito' => 'Cartão de débito', 
        'Dinheiro' => 'Dinheiro', 
    ];

    /**
     * Função responsável 
     * pelo boot do modelo.
     * 
     * @return void
     */
    protected static function boot()
    {
        // Executa as funções da classe
        // extendida.
        parent::boot();

        // Ao retornarmos este recurso, sempre iremos
        // verificar o status do mesmo, evitando que
        // seja chamado a função status, toda vez
        // que formos verificar o status do recurso.
        static::retrieved(function ($resource) {
            $resource->status = $resource->retrieveStatus();
        });
    }

    public static function fecharPeriodo($inicio, $termino = null)
    {
        $termino = $termino ?? $inicio;
        $inicio = Carbon::createFromFormat('Y-m-d H:i:s', $inicio);
        $termino = Carbon::createFromFormat('Y-m-d H:i:s', $termino);

        $fechamentos = self::fechamentosPendentes($inicio, $termino);

        if (empty($fechamentos)) {
            throw new \Exception('Nenhuma entrega encontrada para realizar o fechamento. Por favor, escolha outro período');
        }

        $numero = self::whereDate('impresso_em', $inicio->format('Y-m-d'))->whereNotNull('fechado_em')->max('fechado_sequencial') ?? 0;
        $numero++;

        $fechamentos = $fechamentos->whereNull('fechado_em');
        $fechamentos->update([
            'fechado_em' => now(), 
            'fechado_sequencial' => $numero
        ]);
    }

    public function itens()
    {
        return $this->hasMany(EntregaItem::class);
    }

    public function path()
    {
        return config('hello.url') . '/entrega/' . $this->id;
    }

    public function create($fields, $itens = [])
    {
        $this->fill($fields);

        if (array_key_exists('pago', $fields) and $fields['pago'] == 1) {
            $this->concluir(['valor_pago' => $this->valor]);
            $this->update();
        }

        $this->gerarNumero();
        $this->save();

        foreach($itens as $item) {
            $this->itens()->save(new EntregaItem([
                'titulo' => $item['titulo'], 
                'quantidade' => $item['quantidade'],
                'homeopatia' => $item['homeopatia'],  
                'geladeira' => $item['geladeira'], 
                'pedido' => $item['pedido']
            ]));
        }

        return $this;
    }

    /**
     * Retorna se o recurso 
     * foi pago.
     * 
     * @return boolean
     */
    public function estaPago()
    {
        if (empty($this->pago_em)) {
            return false;
        }

        if (empty($this->valor_pago)) {
            return false;
        }

        return $this->valor == $this->valor_pago;
    }

    /**
     * Retorna se o recurso 
     * já foi fechado.
     * 
     * @return boolean
     */
    public function fechado()
    {
        return ! empty($this->fechado_em);
    }
    
    public function concluir(array $params = [])
    {
        $this->valor_pago = $params['valor_pago'];
        $this->pago_em = now();
        $this->update();
    }

    public function desconcluir()
    {
        $this->valor_pago = 0;
        $this->pago_em = null;
        $this->update();
    }

    public function gerarNumero()
    {
        $numero_ultima_entrega = $this->whereDate('envio_em', $this->envio_em)->max('numero_entrega');
        $this->numero_entrega = $numero_ultima_entrega + 1;
        $this->update();
    }

    public function retrieveStatus()
    {
        return (new EntregaStatus($this));
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function scopeOrdenado($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopePagas($query)
    {
        return $query->whereRaw('valor_pago >= valor');
    }

    public function scopePendentes($query)
    {
        return $query->whereRaw('valor_pago < valor');
    }

    public function scopeImpressas($query)
    {
        return $query->whereNotNull('impresso_em');
    }

    public function scopeHoje($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeSemana($query)
    {
        return $query->whereDate('created_at', '>=', today()->startOfWeek())->whereDate('created_at', '<=', today()->endOfWeek());
    }

    public function scopeFechamentosPendentes($query, $inicio = null, $termino = null)
    {
        $query->whereNull('fechado_em');

        if ( ! empty($inicio)) {
            $query->where('impresso_em', '>=', $inicio);
        }

        if ( ! empty($termino)) {
            $query->where('impresso_em', '<=', $termino);
        }

        return $query;
    }

    public function getValorSaldoAttribute()
    {
        return $this->valor - $this->valor_pago;
    }

    public function getValorOuTrocoAttribute()
    {
        return $this->troco > 0 ? $this->troco : $this->valor;
    }
    
}