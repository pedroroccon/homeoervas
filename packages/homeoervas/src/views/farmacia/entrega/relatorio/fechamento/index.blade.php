@extends('hive::layouts.main')
@section('title', 'Relatórios de fechamento das entregas')
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => 'Relatórios de fechamento das entregas'])

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega-relatorio-fechamento')])

{!! Form::open(['url' => url()->current(), 'method' => 'post', 'class' => 'hello-form']) !!}
    @include('farmacia::farmacia.entrega.relatorio.fechamento.partials.form', ['submit_button_text' => 'Gerar relatório'])
{!! Form::close() !!}

@endsection