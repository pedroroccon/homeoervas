@extends('hive::layouts.main')
@section('title', 'Relatórios das entregas')
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => 'Relatórios das entregas'])

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega-relatorio')])

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card card-body">
                <h4 class="h4">Relatório de entregas por semana</h4>
                <p>Exibe as entregas realizadas agrupadas pelo número da semana do ano.</p>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ url(config('hello.url') . '/entrega/relatorio/semanal') }}" class="btn btn-primary btn-sm">Acessar relatório</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection