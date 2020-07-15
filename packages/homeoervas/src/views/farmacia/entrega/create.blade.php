@extends('hive::layouts.main')
@section('title', 'Adicionar entrega')
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => 'Adicionar entrega'])

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega-create')])

{!! Form::open(['url' => config('hello.url') . '/entrega', 'method' => 'post', 'class' => 'hello-form']) !!}
    @include('farmacia::farmacia.entrega.partials.form', ['submit_button_text' => 'Adicionar entrega'])
{!! Form::close() !!}

@endsection