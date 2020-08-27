@extends('hive::layouts.main')
@section('title', 'Relatórios de entregas pendentes por data de entrega')
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => 'Relatórios de entregas pendentes por data de entrega'])

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega-relatorio-pendentes-por-data-de-entrega')])

{!! Form::open(['url' => url()->current(), 'method' => 'post', 'class' => 'hello-form']) !!}
    @include('farmacia::farmacia.entrega.relatorio.pendentes-por-data-de-entrega.partials.form', ['submit_button_text' => 'Gerar relatório'])
{!! Form::close() !!}

@endsection