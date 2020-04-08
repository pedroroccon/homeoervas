@extends('hive::layouts.main')
@section('title', 'Entrega para ' . $entrega->cliente)
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => 'Entrega para ' . $entrega->cliente, 'page_button' => ['Editar', url()->current() . '/edit']])

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega-show', $entrega)])

<div class="container-fluid">

    @component('hive::components.card', ['title' => 'Informações gerais'])

        <div class="row">
            <div class="col-lg-4">
                @component('hive::components.param', ['title' => 'Pedido'])
                    {!! $entrega->pedido ?? '<span class="text-muted">Pedido não informado</span>' !!}
                @endcomponent
            </div>
            <div class="col-lg-2">
                @component('hive::components.param', ['title' => 'Está pago?'])
                    {!! $entrega->estaPago() ? 'Sim' : 'Não' !!}
                @endcomponent
            </div>
            <div class="col-lg-3">
                @component('hive::components.param', ['title' => 'Qtde. itens'])
                    {!! $entrega->itens()->count() !!}
                @endcomponent
            </div>
            <div class="col-lg-3">
                @component('hive::components.param', ['title' => 'Qtde. homeopatias'])
                    {!! $itens->where('homeopatia', true)->count() !!}
                @endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @component('hive::components.param', ['title' => 'Algum item de geladeira?'])
                    {!! $itens->where('geladeira', true)->count() !!}
                @endcomponent
            </div>
            <div class="col-lg-3">
                @component('hive::components.param', ['title' => 'Valor'])
                    {!! $entrega->valor ? 'R$ ' . number_format($entrega->valor, 2, ',', '.') : '<span class="text-muted">Nada consta</span>' !!}
                @endcomponent
            </div>
            <div class="col-lg-3">
                @component('hive::components.param', ['title' => 'Valor pago'])
                    {!! $entrega->valor_pago ? 'R$ ' . number_format($entrega->valor_pago, 2, ',', '.') : '<span class="text-muted">Nada consta</span>' !!}
                @endcomponent
            </div>
            <div class="col-lg-3">
                @component('hive::components.param', ['title' => 'Saldo'])
                    {!! $entrega->valor_saldo ? 'R$ ' . number_format($entrega->valor_saldo, 2, ',', '.') : '<span class="text-muted">Nada consta</span>' !!}
                @endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @component('hive::components.param', ['title' => 'Troco para'])
                    {!! $entrega->troco ? 'R$ ' . number_format($entrega->troco, 2, ',', '.') : '<span class="text-muted">Nada consta</span>' !!}
                @endcomponent
            </div>
            <div class="col-lg-6">
                @component('hive::components.param', ['title' => 'Tipo da entrega'])
                    {!! $entrega->envio ?? '<span class="text-muted">Não informado</span>' !!}
                @endcomponent
            </div>
            <div class="col-lg-3">
                @component('hive::components.param', ['title' => 'Solicitado o envio em'])
                    {!! !empty($entrega->envio_em) ? $entrega->envio_em->format('d/m/Y') : '<span class="text-muted">Não informado</span>' !!}
                @endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @component('hive::components.param', ['title' => 'Responsável'])
                    {!! $entrega->responsavel ?? '<span class="text-muted">Não informado</span>' !!}
                @endcomponent
            </div>
        </div>
    @endcomponent

    @component('hive::components.card', ['title' => 'Informações da entrega'])
        <div class="row">
            <div class="col-lg-12">
                @component('hive::components.param', ['title' => 'Cliente'])
                    {{ $entrega->cliente }}
                @endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                @component('hive::components.param', ['title' => 'CEP'])
                    {!! $entrega->cep ?? '<span class="text-muted">Não informado</span>' !!}
                @endcomponent
            </div>
            <div class="col-lg-8">
                @component('hive::components.param', ['title' => 'Endereço'])
                    {!! $entrega->endereco ?? '<span class="text-muted">Sem endereço</span>' !!}
                @endcomponent
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @component('hive::components.param', ['title' => 'Número'])
                    {!! $entrega->numero ?? '<span class="text-muted">Sem número</span>' !!}
                @endcomponent
            </div>
            <div class="col-lg-4">
                @component('hive::components.param', ['title' => 'Bairro'])
                    {!! $entrega->bairro ?? '<span class="text-muted">Sem bairro</span>' !!}
                @endcomponent
            </div>
            <div class="col-lg-5">
                @component('hive::components.param', ['title' => 'Cidade/estado'])
                    {!! $entrega->cidade ?? '<span class="text-muted">Sem cidade</span>' !!}/{!! $entrega->estado ?? '<span class="text-muted">Sem estado</span>' !!}
                @endcomponent
            </div>
        </div>
    @endcomponent

    @component('hive::components.card', ['title' => 'Itens no pedido'])
        <div class="row">
            <div class="col-lg-12">
                <a href="#" data-toggle="modal" data-target="#m-add-item" class="btn btn-primary btn-sm">Adicionar produto</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table hello-table hello-table-no-wrap mb-0">
                        <thead>
                            <tr>
                                <th>Item/produto</th>
                                <th class="text-right">Qtde.</th>
                                <th class="text-center">Homeopatia?</th>
                                <th class="text-center">Geladeira?</th>
                                <th>Pedido</th>
                                <th class="hello-table-action">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($itens as $item)
                                <tr>
                                    <td>{{ $item->titulo }}</td>
                                    <td class="text-right">{{ number_format($item->quantidade, 2, ',', '.') }}</td>
                                    <td class="text-center">{!! $item->homeopatia ? '<i class="far fa-check-circle fa-fw text-success"></i>' : '<i class="far fa-times-circle fa-fw text-muted"></i>' !!}</td>
                                    <td class="text-center">{!! $item->geladeira ? '<i class="far fa-check-circle fa-fw text-success"></i>' : '<i class="far fa-times-circle fa-fw text-muted"></i>' !!}</td>
                                    <td>{!! $item->pedido ?? '<small class="text-muted">Não informado</small>' !!}</td>
                                    <td class="hello-table-action">
										{!! Form::open(['url' => $item->path(), 'method' => 'delete']) !!}
										    <button class="btn btn-sm btn-link btn-confirm-delete" data-toggle="tooltip" title="Remover" type="submit"><i class="fas fa-trash fa-sm text-danger"></i></button>
										{!! Form::close() !!}
									</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endcomponent

    @component('hive::components.card', ['title' => 'Observações extras'])
        {!! !empty($entrega->observacao) ? nl2br($entrega->observacao) : '<small class="text-muted">Não informado</small>' !!}
    @endcomponent
</div>

<!-- Modals -->
@include('farmacia::farmacia.entrega.item.partials.add', ['resource' => $entrega])

@endsection