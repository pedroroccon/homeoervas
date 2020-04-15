@extends('hive::layouts.main')
@section('title', 'Relatórios das entregas semanais')
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => 'Relatórios de entregas semanais'])

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega-relatorio-semanal')])

{!! Form::open(['url' => url()->current() . '/show', 'method' => 'get', 'class' => 'hello-form']) !!}
    @include('farmacia::farmacia.entrega.relatorio.semanal.partials.form', ['submit_button_text' => 'Gerar relatório'])
{!! Form::close() !!}

@endsection