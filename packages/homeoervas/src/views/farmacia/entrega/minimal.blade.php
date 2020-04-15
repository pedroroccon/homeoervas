@extends('layouts.minimal')
@section('title', 'Adicionar entrega')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['url' => config('hello.url') . '/entrega', 'method' => 'post', 'class' => 'hello-form']) !!}
                @include('farmacia::farmacia.entrega.partials.form', ['submit_button_text' => 'Adicionar entrega'])
            {!! Form::close() !!}
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @component('hive::components.card', ['title' => 'Últimas entregas cadastradas hoje'])
                    <div class="table-responsive">
                        <table class="table hello-table mb-0">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th class="text-right">Itens/valor</th>
                                    <th>Endereço</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Pedroroccon\Farmacia\Entrega::latest()->limit(30)->get() as $entrega)
                                <tr>
                                    <td><strong><a href="{{ url($entrega->path()) }}">{{ $entrega->cliente }}</a></strong><br><small class="text-muted">{{ $entrega->telefone ?? 'Sem telefone associado' }}</small></td>
                                    <td class="text-right">{{ $entrega->itens()->count() }} item(ns)<br><small class="text-muted">R$ {{ number_format($entrega->valor, 2, ',', '.') }}</small></td>
                                    <td>{{ $entrega->endereco }}, N {{ $entrega->numero }}<br><small class="text-muted">{{ $entrega->cidade }}/{{ $entrega->estado }}</small></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endcomponent
            </div>
        </div>
    </div>
@endsection