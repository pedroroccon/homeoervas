<?php

namespace Pedroroccon\Farmacia\Observers;

use Pedroroccon\Farmacia\Entrega;
use Pedroroccon\Farmacia\EntregaItem;
use Pedroroccon\Farmacia\Mails\EntregaRemovidaMail;
use Mail;

class EntregaObserver
{

    public function deleted(Entrega $entrega)
    {
        try {
            Mail::to(explode(';', env('APP_NOTIFICATIONS_EMAIL')))->send(new EntregaRemovidaMail($entrega));
        } catch (Exception $e) {
            return redirect(config('hello.url') . '/entrega')->withErrors(['Houve um problema ao enviar o e-mail de notificação de remoção: ' . $e->getMessage() . '. A mensagem ficará salva nos logs, caso seja necessário consultar. Entrega: ' . $entrega->id]);
        }
    }

}