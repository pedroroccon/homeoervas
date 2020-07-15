@extends('hive::layouts.email', ['empresa' => $empresa])
@section('meta-title', 'Entrega removida - ' . $entrega->numero_entrega . ' - ' . $entrega->cliente)
@section('pre-header', 'Remoção da entrega ' . $entrega->numero_entrega . ', dia ' . $entrega->created_at->format('d/m/Y'))
@section('content')

<p>Prezado(a), </p>
<p>Você está recebendo um comunicado de entrega removida do sistema. A entrega não está mais disponível na aplicação, mas você pode conferir os detalhes dela abaixo:<p>

<p>
    <strong>Número</strong>: {{ $entrega->numero_entrega }}<br>
    <strong>Cliente</strong>: {{ $entrega->cliente }}<br>
    <strong>Telefone</strong>: {{ $entrega->telefone }}<br>
    <strong>Endereco</strong>: {{ $entrega->endereco }}<br>
    <strong>Número</strong>: {{ $entrega->numero }}<br>
    <strong>Bairro</strong>: {{ $entrega->bairro }}<br>
    <strong>Cidade</strong>: {{ $entrega->cidade }}<br>
    <strong>Estado</strong>: {{ $entrega->estado }}<br>
    <strong>CEP</strong>: {{ $entrega->cep }}<br>
    <strong>Valor</strong>: R$ {{ number_format($entrega->valor, 2, ',', '.') }}<br>
    <strong>Valor pago</strong>: R$ {{ number_format($entrega->valor_pago, 2, ',', '.') }}<br>
    <strong>Pago em</strong>: {{ ! empty($entrega->pago_em) ? $entrega->pago_em->format('d/m/Y') : 'Não efetuado/informado' }}<br>
    <strong>Forma de pagamento</strong>: {{ $entrega->forma_pagamento }}<br>
    <strong>Troco</strong>: R$ {{ number_format($entrega->troco, 2, ',', '.') }}<br>
</p>

<p>Essa mensagem é enviada automaticamente através<br>
do sistema de gestão de entregas. Não é necessário responder.<br>
{{ $empresa->titulo }}</p>
@endsection