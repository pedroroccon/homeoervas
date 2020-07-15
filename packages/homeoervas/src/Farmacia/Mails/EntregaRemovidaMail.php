<?php

namespace Pedroroccon\Farmacia\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Pedroroccon\Farmacia\Entrega;

class EntregaRemovidaMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Recebe as informações da empresa
     * associada a essa aplicação.
     * 
     * @var \Byus\Hello\Empresa
     */
    public $empresa;

    /**
     * Recebe o recurso
     * relacionada a entrega.
     *
     * @var \Pedroroccon\Farmacia\Entrega
     */
    public $entrega;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Entrega $entrega)
    {
        $this->empresa = cache('empresa');
        $this->entrega = $entrega;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('farmacia::farmacia.mails.entrega-removida')
            ->subject('Entrega removida - ' . $this->entrega->numero_entrega . ' - ' . $this->entrega->cliente);
    }
}