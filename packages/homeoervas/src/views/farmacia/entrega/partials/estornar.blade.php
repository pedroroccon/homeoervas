@component('hive::components.modals', ['id' => 'm-estornar', 'title' => 'Estornar entrega'])
	{!! Form::open(['url' => '#', 'class' => 'hello-form']) !!}
		<div class="modal-body">
			@component('hive::components.alerts.warning')
				Tem certeza que deseja estornar a entrega? Essa ação fará com que a entrega seja marcada como "pendente" novamente.
			@endcomponent
		</div>
		<div class="modal-footer">
			{!! Form::submit('Estornar entrega', ['class' => 'btn btn-warning']) !!}
		</div>
	{!! Form::close() !!}
@endcomponent