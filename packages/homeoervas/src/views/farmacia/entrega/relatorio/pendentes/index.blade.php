@extends('hive::layouts.main')
@section('title', 'Relatórios de entregas pendentes')
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => 'Relatórios de entregas pendentes'])

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega-relatorio-pendentes')])

{!! Form::open(['url' => url()->current(), 'method' => 'post', 'class' => 'hello-form']) !!}
    @include('farmacia::farmacia.entrega.relatorio.pendentes.partials.form', ['submit_button_text' => 'Gerar relatório'])
{!! Form::close() !!}

@endsection