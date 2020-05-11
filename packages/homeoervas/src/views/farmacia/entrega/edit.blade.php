@extends('hive::layouts.main')
@section('title', $entrega->cliente . ' - Editar entrega')
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => $entrega->cliente . ' - Editar entrega'])

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega-edit', $entrega)])

{!! Form::model($entrega, ['url' => $entrega->path(), 'method' => 'patch', 'class' => 'hello-form']) !!}
    @include('farmacia::farmacia.entrega.partials.form-edit', ['submit_button_text' => 'Editar entrega'])
{!! Form::close() !!}

@endsection