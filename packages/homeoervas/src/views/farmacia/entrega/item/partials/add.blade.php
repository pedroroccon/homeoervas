@component('hive::components.modals', ['id' => 'm-add-item', 'title' => 'Concluir'])
	{!! Form::open(['url' => $resource->path() . '/item', 'class' => 'hello-form']) !!}
		<div class="modal-body">
            @include('farmacia::farmacia.entrega.item.partials.form')
		</div>
		<div class="modal-footer">
			{!! Form::submit('Adicionar item', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endcomponent