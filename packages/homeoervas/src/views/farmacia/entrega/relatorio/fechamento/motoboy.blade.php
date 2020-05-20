@extends('hive::layouts.main')
@section('title', 'Relatórios de fechamento das entregas')
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => 'Relatórios de fechamento das entregas'])

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega-relatorio-fechamento')])

<div class="container-fluid">

	<div class="row">
		<div class="col-lg-3">
			<div class="card card-body border-0 text-primary shadow mb-4">
				<div class="media">
					<span class="align-self-center mr-3"><i class="fas fa-truck fa-2x mr-2"></i></span>
					<div class="media-body">
						<span class="lead d-block">{{ $entregasRealizadas }}</span>
						<small class="d-block">
							Entregas no <br>período
						</small>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card card-body border-0 text-success shadow mb-4">
				<div class="media">
					<span class="align-self-center mr-3"><i class="fas fa-thumbs-up fa-2x fa-fw"></i></span>
					<div class="media-body">
						<span class="lead d-block">{{ $entregasPagas }}</span>
						<small class="d-block">
							Entregas pagas <br>+R$ {{ number_format($entregasPagas * config('farmacia.valor_por_entrega'), 2, ',', '.') }}
						</small>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-striped hello-table hello-table-no-wrap mb-0">
			<thead>
				<tr>
					<th>Data</th>
					<th class="text-right">Entregas</th>
					<th class="text-right">Concluídas</th>
					<th class="text-right">Pendentes</th>
					<th class="text-right">Valor do acerto</th>
					<th class="hello-table-action">Ações</th>
				</tr>
			</thead>
			<tbody>
				@foreach($entregasPorDia as $dia => $entregasAgrupadas)
					<tr>
						<td>{{ $dia }}</td>
						<td class="text-right">{{ $entregasAgrupadas->count() }}</td>
						<td class="text-right">{{ $entregasAgrupadas->filter(function($i) { return $i->valor_pago >= $i->valor; })->count() }}</td>
						<td class="text-right">{{ $entregasAgrupadas->filter(function($i) { return $i->valor_pago < $i->valor; })->count() }}</td>
						<td class="text-right">R$ {{ number_format($entregasAgrupadas->filter(function($i) { return $i->valor_pago >= $i->valor; })->count() * config('farmacia.valor_por_entrega'), 2, ',', '.') }}</td>
						<td class="hello-table-action"><a data-toggle="tooltip" title="Detalhes do dia" href="{{ url(config('hello.url') . '/entrega/relatorio/fechamento/gerar?data=' . implode('-', array_reverse(explode('/', $dia))) . '&ordenar=numero_entrega&tipo=diario') }}" target="_blank"><i class="fas fa-info-circle"></i></a></td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td>Totalizador</td>
					<td class="text-right">{{ $entregas->count() }}</td>
					<td class="text-right">{{ $entregas->filter(function($i) { return $i->valor_pago >= $i->valor; })->count() }}</td>
					<td class="text-right">{{ $entregas->filter(function($i) { return $i->valor_pago < $i->valor; })->count() }}</td>
					<td class="text-right">R$ {{ number_format($entregas->filter(function($i) { return $i->valor_pago >= $i->valor; })->count() * config('farmacia.valor_por_entrega'), 2, ',', '.') }}</td>
					<td class="hello-table-action">-</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

@endsection