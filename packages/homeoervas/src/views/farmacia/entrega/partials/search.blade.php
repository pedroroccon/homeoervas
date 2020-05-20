@component('hive::components.modals', ['id' => 'm-search', 'title' => 'Pesquisar'])
	{!! Form::open(['url' => url()->current(), 'method' => 'GET', 'class' => 'hello-form']) !!}
	<div class="modal-body">
		<div class="row form-group">
			<div class="col">
				{!! Form::label('keyword', 'Pesquisar') !!}
				{!! Form::text('keyword', null, ['class' => 'form-control']) !!}
				<p class="form-text">Digite o termo, ou parte da palavra que deseja pesquisar.</p>
			</div>
		</div>
		<div class="row form-group">
			<div class="col">
				{!! Form::label('campo', 'Pesquisar em') !!}
				{!! Form::select('campo', [
				    'cliente' => 'Cliente', 
				    'endereco' => 'Endereço', 
                    'cidade' => 'Cidade', 
                    'estado' => 'Estado', 
                    'responsavel' => 'Responsável', 
				], null, ['class' => 'form-control']) !!}
				<p class="form-text">Selecione em qual campo você deseja pesquisar a sua palavra-chave.</p>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-lg-12">
				{!! Form::label('envio_em', 'Pesquisar entregas do dia') !!}
				{!! Form::date('envio_em', null, ['class' => 'form-control']) !!}
				<span class="form-text">Informe uma data caso queira filtrar apenas entregas referentes a data acima. A data acima se refere data na qual o item deveria ser enviado.</span>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		{!! Form::submit('Pesquisar', ['class' => 'btn btn-primary']) !!}
	</div>
	{!! Form::close() !!}
@endcomponent