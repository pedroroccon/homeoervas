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
                <h4 class="h4">Relatório de fechamento de entregas</h4>
                <p>Exibe um relatório listando as entregas fechadas por períodos.</p>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ url(config('hello.url') . '/entrega/relatorio/fechamento') }}" class="btn btn-primary btn-sm">Acessar relatório</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-body">
                <h4 class="h4">Relatório de entregas pendentes</h4>
                <p>Exibe as entregas classificadas como pendentes, ou seja, que não foram concluídas/pagas, considerando a data em que a impressão foi realizada.</p>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ url(config('hello.url') . '/entrega/relatorio/pendentes') }}" class="btn btn-primary btn-sm">Acessar relatório</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-body">
                <h4 class="h4">Relatório de entregas pendentes por data de entrega</h4>
                <p>Exibe as entregas classificadas como pendentes, ou seja, que não foram concluídas/pagas, considerando a data em que a entrega foi realizada.</p>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ url(config('hello.url') . '/entrega/relatorio/pendentes-por-data-de-entrega') }}" class="btn btn-primary btn-sm">Acessar relatório</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection