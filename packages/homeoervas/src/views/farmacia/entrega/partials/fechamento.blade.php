@component('hive::components.modals', ['id' => 'm-fechamento', 'title' => 'Realizar fechamento'])
	{!! Form::open(['url' => url()->current() . '/fechamento', 'method' => 'get', 'class' => 'hello-form']) !!}
	<div class="modal-body">
		<div class="row form-group">
			<div class="col-lg-12">
				{!! Form::label('dia', 'Dia para realizar o fechamento') !!}
				{!! Form::date('dia', today(), ['class' => 'form-control']) !!}
				<span class="form-text">Informe em qual dia você deseja realizar o fechamento.</span>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-lg-6">
				{!! Form::label('inicio_hora', 'Hora de início') !!}
				{!! Form::text('inicio_hora', '07:00', ['class' => 'form-control']) !!}
				<span class="form-text">Informe a horário de início do período referente ao fechamento.</span>
			</div>
			<div class="col-lg-6">
				{!! Form::label('termino_hora', 'Hora de término') !!}
				{!! Form::text('termino_hora', '19:00', ['class' => 'form-control']) !!}
				<span class="form-text">Informe a horário de término do período referente ao fechamento.</span>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		{!! Form::submit('Realizar fechamento', ['class' => 'btn btn-primary']) !!}
	</div>
	{!! Form::close() !!}
@endcomponent