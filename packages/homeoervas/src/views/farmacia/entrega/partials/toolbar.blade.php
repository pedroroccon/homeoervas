<div class="hello-table-toolbar">
	<div class="d-flex">
		<div class="hello-form w-100 hello-table-toolbar-search">
			{!! Form::open(['url' => url()->current(), 'method' => 'get']) !!}
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-search"></i></span>
					</div>
					{!! Form::text('keyword', null, ['class' => 'form-control form-control-sm mr-4', 'placeholder' => $placeholder, 'id' => 'quick-search', 'autocomplete' => 'off']) !!}
				</div>
				{!! Form::hidden('campo', 'auto') !!}
			{!! Form::close() !!}
		</div>
		<button class="btn btn-sm btn-link" v-on:click="sendToPrint()"><i class="fas fa-print fa-fw mr-2"></i> Imprimir</button>
		<a data-toggle="modal" data-target="#m-search" href="#" class="btn btn-sm btn-link"><i class="fas fa-filter fa-sm mr-2"></i> Filtrar</a>
		<a data-toggle="modal" data-target="#m-fechamento" href="#" class="btn btn-sm btn-link"><i class="fas fa-chart-line fa-sm mr-2"></i> Fechamento</a>
		{!! request()->query() ? '<a href="' . url(request()->url()) . '" class="btn btn-sm btn-link text-danger"><i class="far fa-times-circle mr-2"></i>Cancelar filtro</a>' : null !!}
	</div>
</div>

<script type="application/javascript">
	$(function()
	{
		$('#quick-search').autocomplete(
		{
			source: function(request, response) {
				$.ajax({
					url: '{{ url('api/produto') }}',
					data: { keyword: request.term, campo: 'smart' },
					dataType: 'json',
					success: response,
					error: function() { response([]); }
				});
			},
			minLength: 3,
			select: function(event, ui)
			{
				window.location.href = '{{ url(config('hello.url') . '/produto/') }}' + '/' + ui.item.id;
			}
		}).autocomplete('instance')._renderItem = function(ul, item) {
			return $('<li>').append(item.codigo + ' - <strong>' + item.titulo + '</strong>').appendTo(ul);
		};
	}, (jQuery));
</script>