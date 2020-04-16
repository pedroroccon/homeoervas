
@extends('hive::layouts.main')
@section('title', 'Entregas')
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => 'Relatório de entregas semanais'])
<div class="container-fluid">
	<p>Exibindo entregas entre {{ Carbon\Carbon::createFromFormat('Y-m-d', $request->inicio)->format('d/m/Y') }} até {{ Carbon\Carbon::createFromFormat('Y-m-d', $request->termino)->format('d/m/Y') }}. Relatório emitido em {{ now()->format('d/m/Y H:i') }}, por {{ auth()->user()->name }}</p>
</div>

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega-relatorio-semanal')])

<div class="container-fluid">

	@if($entregasAgrupadas->count())
		@foreach($entregasAgrupadas as $grupo)
			@component('hive::components.card', ['title' => $grupo[0]->impresso_em->format('m/Y') . ', semana ' . $grupo[0]->impresso_em->format('W') . '. De ' . $grupo[0]->impresso_em->startOfWeek()->format('d/m/Y') . ' até ' . $grupo[0]->impresso_em->endOfWeek()->format('d/m/Y')])

				<table>
					<tr>
						<td>
							<div class="p-3 text-secondary mb-4 text-center">
								<div class="media">
									<span class="align-self-center mr-3"><i class="fas fa-truck fa-2x mr-2"></i></span>
									<div class="media-body">
										<span class="lead d-block">R$ {{ number_format($grupo->sum('valor'), 2, ',', '.') }}</span>
										<small class="d-block">
											Entregas no período<br>
											Totalizando {{ $grupo->count() }} entrega(s)
										</small>
									</div>
								</div>
							</div>
						</td>
						<td>
							<div class="p-3 text-secondary mb-4 text-center">
								<div class="media">
									<span class="align-self-center mr-3"><i class="fas fa-stopwatch fa-2x mr-2"></i></span>
									<div class="media-body">
										<span class="lead d-block">R$ {{ number_format($grupo->filter(function($key) { return $key->impresso_em->hour <= 12; })->sum('valor'), 2, ',', '.') }}</span>
										<small class="d-block">
											No período da manhã<br>
											Até 13hrs
										</small>
									</div>
								</div>
							</div>
						</td>
						<td>
							<div class="p-3 text-secondary mb-4 text-center">
								<div class="media">
									<span class="align-self-center mr-3"><i class="fas fa-stopwatch fa-2x mr-2"></i></span>
									<div class="media-body">
										<span class="lead d-block">R$ {{ number_format($grupo->filter(function($key) { return $key->impresso_em->hour > 13; })->sum('valor'), 2, ',', '.') }}</span>
										<small class="d-block">
											No período da tarde<br>
											Após as 13hrs
										</small>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</table>

				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table class="table hello-table hello-table-no-wrap mb-0">
								<tbody>
        		                    @foreach($grupo as $entrega)
        		                        <tr>
        		                            <td>{{ $entrega->numero_entrega }}</td>
        		                            <td><strong><a href="{{ url($entrega->path()) }}">{{ $entrega->cliente }}</a></strong><br><small class="text-muted">{{ $entrega->telefone ?? 'Sem telefone associado' }}</small></td>
        		                            <td class="text-right">R$ {{ number_format($entrega->valor, 2, ',', '.') }}<br><small class="text-muted">{{ $entrega->itens()->count() }} item(ns)</small></td>
        		                            <td>{{ $entrega->impresso_em->format('d/m/Y') }}<br><small class="text-muted">{{ $entrega->impresso_em->format('H:i') }}</small></td>
        		                            <td>{{ $entrega->endereco }}, N {{ $entrega->numero }}<br><small class="text-muted">{{ $entrega->bairro }} - {{ $entrega->cidade }}/{{ $entrega->estado }}</small></td>
        		                        </tr>
        		                    @endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			@endcomponent
		@endforeach
	@else
		@include('hive::components.no-results')
	@endif

</div>
@endsection