
@extends('hive::layouts.main')
@section('title', 'Entregas')
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => 'Entregas', 'page_button' => ['Adicionar', url()->current() . '/create']])

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega')])

<div class="container-fluid">

	<div class="row">
		<div class="col-lg-6">
			<div class="card card-body border-0 text-primary shadow mb-4">
				<div class="media">
					<span class="align-self-center mr-3"><i class="fas fa-truck fa-2x mr-2"></i></span>
					<div class="media-body">
						<span class="lead d-block">R$ {{ number_format($entregasFeitasHoje->sum('valor'), 2, ',', '.') }}</span>
						<small class="d-block">
							Entregas hoje {{ today()->format('d/m/Y') }}<br>
						</small>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card card-body border-0 text-secondary shadow mb-4">
				<div class="media">
					<span class="align-self-center mr-3"><i class="fas fa-stopwatch fa-2x mr-2"></i></span>
					<div class="media-body">
						<span class="lead d-block">R$ {{ number_format($entregasFeitasDeManha->sum('valor'), 2, ',', '.') }}</span>
						<small class="d-block">
							No período da manhã<br>
						</small>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="card card-body border-0 text-secondary shadow mb-4">
				<div class="media">
					<span class="align-self-center mr-3"><i class="fas fa-stopwatch fa-2x mr-2"></i></span>
					<div class="media-body">
						<span class="lead d-block">R$ {{ number_format($entregasFeitasDeTarde->sum('valor'), 2, ',', '.') }}</span>
						<small class="d-block">
							No período da tarde<br>
						</small>
					</div>
				</div>
			</div>
		</div>
	</div>


    <div class="card">
		<div class="card-body">
		
			@include('farmacia::farmacia.entrega.partials.toolbar', ['placeholder' => 'Pesquisar entrega...'])

			@if($entregas->count())
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table class="table hello-table hello-table-no-wrap mb-0">
								<thead>
									<tr>
										<th>Nº</th>
										<th>&nbsp;</th>
										<th>Cliente</th>
										<th class="text-right">Itens/valor</th>
                                        <th>Endereço</th>
                                        <th>Status</th>
										<th class="text-center"><i class="fas fa-print fa-fw"></i></th>
										<th class="text-center"><i class="far fa-check-circle fa-fw"></i></th>
										<th class="hello-table-action">Ações</th>
									</tr>
								</thead>
								<tbody>
									@foreach($entregas as $entrega)
									<tr>
										<td>{{ $entrega->numero_entrega }}</td>
										<td>{!! Form::checkbox('selectedResources[]', $entrega->id, 0, ['v-model' => 'selectedResources']) !!}</td>
										<td><strong><a href="{{ url($entrega->path()) }}">{{ $entrega->cliente }}</a></strong><br><small class="text-muted">{{ $entrega->telefone ?? 'Sem telefone associado' }}</small></td>
										<td class="text-right">{{ $entrega->itens()->count() }} item(ns)<br><small class="text-muted">R$ {{ number_format($entrega->valor, 2, ',', '.') }}</small></td>
										<td>{{ $entrega->endereco }}, N {{ $entrega->numero }}<br><small class="text-muted">{{ $entrega->bairro }} - {{ $entrega->cidade }}/{{ $entrega->estado }}</small></td>
                                        <td class="{{ $entrega->status->classe }}">{{ $entrega->status->descricao }}<br><small>{{ $entrega->status->data->format('d/m/Y H:i') }}</small></td>
                                        <td class="text-center"><i data-toggle="tooltip" title="{{ ! empty($entrega->impresso_em) ? 'Impresso em ' . $entrega->impresso_em->format('d/m/Y') : 'Não impresso' }}" class="fas fa-print fa-fw {{ ! empty($entrega->impresso_em) ? 'text-success' : 'text-light' }}"></i></td>
										<td class="text-center"><i class="fa-check-circle fa-fw {{ $entrega->fechado() ? 'fas text-success' : 'far text-muted' }}" data-toggle="tooltip" title="{{ $entrega->fechado() ? 'Entrega fechada' : 'Entrega em aberto' }}"></i></td>
										<td class="hello-table-action">
											{!! Form::open(['url' => $entrega->path(), 'method' => 'delete']) !!}
												@if ( ! $entrega->estaPago())
													<span data-toggle="tooltip" title="Concluir entrega"><a class="btn btn-sm btn-link" data-toggle="modal" data-target="#m-concluir" data-url="{{ url($entrega->path() . '/concluir') }}" href="#" data-cliente="{{ $entrega->cliente }}" data-valor="{{ $entrega->valor }}" data-troco="{{ $entrega->troco }}" data-forma-pagamento="{{ $entrega->forma_pagamento }}"><i class="fas fa-truck fa-sm"></i></a></span>
												@endif
											    <button class="btn btn-sm btn-link btn-confirm-delete" data-toggle="tooltip" title="Remover" type="submit"><i class="fas fa-trash fa-sm text-danger"></i></button>
											{!! Form::close() !!}
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			@else
				@include('hive::components.no-results')
			@endif

		</div>
		
		<!-- Paginação -->
		@include('hive::components.pagination', ['resource' => $entregas->appends(request()->except('page')), 'wrapper' => 'card-footer'])

	</div>
</div>

<!-- Modals -->
@include('farmacia::farmacia.entrega.partials.search')
@include('farmacia::farmacia.entrega.partials.concluir')
@include('farmacia::farmacia.entrega.partials.fechamento')

@endsection

@section('script')
	@parent

	<script type="application/javascript">
		const app = new Vue({
			el: '#app', 
			data: {
				selectedResources: []
			}, 
			methods: {
				sendToPrint: function() {
					window.open('{{ url('entrega/imprimir') }}?entregas=' + this.selectedResources.join(','), '_blank');
					location.reload();
				}
			}
		});

		$(function() {
			$('#m-concluir').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget);
				var modal = $(this);
				modal.find('form').attr('action', button.data('url'));
				modal.find('.modal-title').text('Concluir entrega para ' + button.data('cliente'));
				modal.find('.modal-body #valor_pago').val(button.data('valor'));
				modal.find('.modal-body #troco').val(button.data('troco'));
				modal.find('.modal-body #forma_pagamento').val(button.data('forma-pagamento'));
			});
		});

	</script>

@endsection