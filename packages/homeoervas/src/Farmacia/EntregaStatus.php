<?php

namespace Pedroroccon\Farmacia;

use Pedroroccon\Hello\Statusable;

class EntregaStatus extends Statusable
{
    public function processar()
    {
        if ($this->recurso->valor_saldo <= 0 and  ! empty($this->recurso->pago_em)) {
            $this->codigo = 'c';
            $this->descricao = 'Pago R$ ' . number_format($this->recurso->valor_pago, 2, ',', '.');
            $this->classe = 'text-success';
            $this->step = 3;
            $this->data = $this->recurso->pago_em;

            return $this;
        }

        if ($this->recurso->valor_saldo > 0 and $this->recurso->valor_pago > 0) {
            $this->codigo = 'd';
            $this->descricao = 'Em aberto R$ ' . number_format($this->recurso->valor_saldo, 2, ',', '.');
            $this->classe = 'text-warning';
            $this->step = 2;
            $this->data = $this->recurso->pago_em;

            return $this; 
        }
        
        $this->codigo = 'x';
        $this->descricao = 'Pendente';
        $this->step = 0;
        $this->classe = 'secondary animated flash infinite';
        $this->data = $this->recurso->envio_em;

        return $this;
    }
}