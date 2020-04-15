<?php

namespace Pedroroccon\Farmacia;

use Illuminate\Database\Eloquent\Model as Model;

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
        'troco', 
        // 'itens', 
        // 'itens_geladeira', 
        // 'homeopatias', 
        'envio', 
        'envio_em', 
        'observacao', 
        'responsavel', 
    ];

    protected $dates = [
        'pago_em', 
        'envio_em', 
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

    public function itens()
    {
        return $this->hasMany(EntregaItem::class);
    }

    public function path()
    {
        return config('hello.url') . '/entrega/' . $this->id;
    }

    public function estaPago()
    {
        return $this->valor == $this->valor_pago;
    }

    public function concluir(array $params = [])
    {
        $this->valor_pago = $params['valor_pago'];
        $this->pago_em = now();
        $this->update();
    }

    public function gerarNumero()
    {
        $inicio = $this->created_at->startOfWeek();
        $termino = $this->created_at->endOfWeek();

        $numero_ultima_entrega = $this->whereDate('created_at', '>=', $inicio)->whereDate('created_at', '<=', $termino)->max('numero_entrega');
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

    public function getValorSaldoAttribute()
    {
        return $this->valor - $this->valor_pago;
    }
    
}