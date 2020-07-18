@extends('hive::layouts.main')
@section('title', 'Relatórios de entregas pendentes')
@section('content')

<!-- Header -->
@include('hive::components.title', ['page_title' => 'Relatórios de entregas pendentes'])

<!-- Breadcrumbs -->
@include('hive::components.breadcrumbs', ['breadcrumb' => Breadcrumbs::render('hello-entrega-relatorio-pendentes')])

<div class="container-fluid">

	<div class="row">
		<div class="col-lg-3">
			<p>Exibindo entregas pendentes no período de {{ Carbon\Carbon::createFromFormat('Y-m-d', $request->inicio)->format('d/m/Y') }} até {{ Carbon\Carbon::createFromFormat('Y-m-d', $request->termino)->format('d/m/Y') }}</p>
		</div>
	</div>

	<div class="row d-print-none">
		<div class="col-lg-12">
			<a href="#" class="btn btn-primary" onclick="window.print()"><i class="fas fa-print fa-fw mr-2"></i>Imprimir</a>
			<hr>
		</div>
	</div>
	

	<table class="table hello-table hello-table-no-wrap mb-0 table-sm">
		<thead>
			<tr>
				<th>Nº</th>
				<th>Cliente</th>
				<th class="text-right">Itens</th>
				<th class="text-right">Valor</th>
				<th>Endereço</th>
				<th>Bairro, cidade e estado</th>
				<th>Status</th>
				<th>Data</th>
			</tr>
		</thead>
		<tbody>
			@foreach($entregas as $entrega)
			<tr>
				<td>{{ $entrega->numero_entrega }}</td>
				<td>{{ $entrega->cliente }}</td>
				<td class="text-right">{{ $entrega->itens()->count() }}</td>
				<td class="text-right">R$ {{ number_format($entrega->valor_ou_troco, 2, ',', '.') }}</td>
				<td>{{ $entrega->endereco }}, N {{ $entrega->numero }}</td>
				<td>{{ $entrega->bairro }} - {{ $entrega->cidade }}/{{ $entrega->estado }}</td>
				<td>{{ $entrega->status->descricao }}</td>
				<td>{{ !empty($entrega->status->data) ? $entrega->status->data->format('d/m/Y') : 'Não informado' }}</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2">Totalizadores</td>
				<td class="text-right">&nbsp;</td>
				<td class="text-right">R$ {{ number_format($entregas->sum('valor_ou_troco'), 2, ',', '.') }}</td>
				<td colspan="4">&nbsp;</td>
			</tr>
		</tfoot>
	</table>
</div>

@endsection