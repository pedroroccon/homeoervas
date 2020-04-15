@extends('hive::layouts.main')
@section('title', 'Relatórios das entregas')
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => 'Relatórios das entregas'])

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega-relatorio')])

<div class="container-fluid">

</div>

@endsection