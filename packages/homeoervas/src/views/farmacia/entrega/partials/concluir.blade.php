@component('hive::components.modals', ['id' => 'm-concluir', 'title' => 'Concluir'])
	{!! Form::open(['url' => '#', 'class' => 'hello-form']) !!}
		<div class="modal-body">
			<div class="row form-group">
				<div class="col-lg-12">
					{!! Form::label('valor_pago', 'Valor pago') !!}
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">R$</span>
						</div>
						{!! Form::number('valor_pago', null, ['class' => 'form-control', 'step' => 'any']) !!}
					</div>
					<span class="form-text">Informe o valor pago na entrega. Caso o valor pago seja menor do que o valor do pedido, o sistema irá colocar a sua entrega com o status de "cobrança pendente".</span>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			{!! Form::submit('Concluir', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endcomponent