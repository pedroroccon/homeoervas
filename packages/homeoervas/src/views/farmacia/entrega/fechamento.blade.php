
@extends('hive::layouts.main')
@section('title', 'Fechamento de entregas')
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => 'Fechamento de entregas', 'page_button' => ['Adicionar', url()->current() . '/create']])

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega-fechamento')])

<div class="container-fluid">

	<div class="card card-body border-success mb-3">
		<div class="row">
			<div class="col-lg-12">
				{!! Form::open(['url' => config('hello.url') . '/entrega/fechamento']) !!}
					{!! Form::hidden('inicio', $request->dia . ' ' . $request->inicio_hora . ':00') !!}
					{!! Form::hidden('termino', $request->dia . ' ' . $request->termino_hora . ':00') !!}
					<span class="text-success d-block mb-3">As entregas listadas abaixo serão encerradas. Tem certeza que deseja encerrar o período?</span>
					<button type="submit" class="btn btn-success"><i class="far fa-check-circle fa-fw mr-2"></i> Encerrar período</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			@if($entregas->count())
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table class="table hello-table hello-table-no-wrap mb-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Cliente</th>
										<th class="text-right">Itens/valor</th>
                                        <th>Endereço</th>
                                        <th>Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach($entregas as $entrega)
									<tr>
										<td>{{ $entrega->numero_entrega }}</td>
										<td><strong><a href="{{ url($entrega->path()) }}">{{ $entrega->cliente }}</a></strong><br><small class="text-muted">{{ $entrega->telefone ?? 'Sem telefone associado' }}</small></td>
										<td class="text-right">{{ $entrega->itens()->count() }} item(ns)<br><small class="text-muted">R$ {{ number_format($entrega->valor, 2, ',', '.') }}</small></td>
										<td>{{ $entrega->endereco }}, N {{ $entrega->numero }}<br><small class="text-muted">{{ $entrega->bairro }} - {{ $entrega->cidade }}/{{ $entrega->estado }}</small></td>
                                        <td class="{{ $entrega->status->classe }}">{{ $entrega->status->descricao }}<br><small>{{ $entrega->status->data->format('d/m/Y H:i') }}</small></td>
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
	</div>
</div>

@endsection