@component('hive::components.modals', ['id' => 'm-concluir', 'title' => 'Concluir'])
	{!! Form::open(['url' => '#', 'class' => 'hello-form']) !!}
		<div class="modal-body">
			<div class="row">
				<div class="col-lg-6 form-group">
					{!! Form::label('valor_pago', 'Valor retornado') !!}
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">R$</span>
						</div>
						{!! Form::number('valor_pago', null, ['class' => 'form-control', 'step' => 'any']) !!}
					</div>
					<span class="form-text">Informe o valor retornado da entrega. Caso o valor retornado seja menor do que o valor do pedido, o sistema irá colocar a sua entrega com o status de "cobrança pendente".</span>
				</div>
				<div class="col-lg-6 form-group">
					{!! Form::label('troco', 'Valor do troco') !!}
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">R$</span>
						</div>
						{!! Form::number('troco', null, ['class' => 'form-control', 'readonly']) !!}
					</div>
					<span class="form-text">O valor do troco referenciado acima foi definido no cadastro desta entrega, e serve como parâmetro de conferência.</span>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 form-group">
					{!! Form::label('forma_pagamento', 'Forma de pagamento') !!}
					{!! Form::select('forma_pagamento', [
						'' => 'Por favor, selecione...', 
					] + Pedroroccon\Farmacia\Entrega::$forma_pagamento_list, null, ['class' => 'form-control']) !!}
					<span class="form-text">Informe a forma de pagamento.</span>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			{!! Form::submit('Concluir', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endcomponent