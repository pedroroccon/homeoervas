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
		<div class="col-lg-3">
			<div class="card card-body border-0 text-danger shadow mb-4">
				<div class="media">
					<span class="align-self-center mr-3"><i class="fas fa-thumbs-down fa-2x fa-fw"></i></span>
					<div class="media-body">
						<span class="lead d-block">{{ $entregasNaoPagas }}</span>
						<small class="d-block">
							Entregas não pagas <br>-R$ {{ number_format($entregasNaoPagas * config('farmacia.valor_por_entrega'), 2, ',', '.') }}
						</small>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card card-body border-0 text-secondary shadow mb-4">
				<div class="media">
					<span class="align-self-center mr-3"><i class="fas fa-dollar-sign fa-2x fa-fw"></i></span>
					<div class="media-body">
						<span class="lead d-block">{{ $entregasNaoPagas }}</span>
						<small class="d-block">
							Valor no período <br>R$ {{ number_format($entregasPagas * config('farmacia.valor_por_entrega') - ($entregasNaoPagas * config('farmacia.valor_por_entrega')), 2, ',', '.') }}
						</small>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	@foreach($periodos as $periodo)

		
		@component('hive::components.card', ['title' => 'Período ' . $periodo->first()->fechado_sequencial . ' - De ' . $periodo->first()->impresso_em->format('d/m/Y H:i') . ' até ' . $periodo->last()->impresso_em->format('d/m/Y H:i')])
			<div class="table-responsive">
				<table class="table hello-table hello-table-no-wrap mb-0">
					<thead>
						<tr>
							<th>Nº</th>
							<th>Cliente</th>
							<th class="text-right">Itens/valor</th>
							<th>Endereço</th>
							<th>Pago?</th>
							<th class="hello-table-action">Ações</th>
						</tr>
					</thead>
					<tbody>
						@foreach($periodo as $entrega)
							<tr>
								<td>{{ $entrega->numero_entrega }}</td>
								<td><strong><a href="{{ url($entrega->path()) }}">{{ $entrega->cliente }}</a></strong><br><small class="text-muted">{{ $entrega->telefone ?? 'Sem telefone associado' }}</small></td>
								<td class="text-right">{{ $entrega->itens()->count() }} item(ns)<br><small class="text-muted">R$ {{ number_format($entrega->valor, 2, ',', '.') }}</small></td>
								<td>{{ $entrega->endereco }}, N {{ $entrega->numero }}<br><small class="text-muted">{{ $entrega->bairro }} - {{ $entrega->cidade }}/{{ $entrega->estado }}</small></td>
								<td>{!! $entrega->pago_em ? 'Sim' : '<span class="text-muted">Não</span>' !!}</td>
								<td class="hello-table-action">
									-
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@endcomponent

	@endforeach

</div>

@endsection