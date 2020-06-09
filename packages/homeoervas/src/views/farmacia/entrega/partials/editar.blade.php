@component('hive::components.modals', ['id' => 'm-editar', 'title' => 'Editar entrega'])
	{!! Form::model($resource, ['url' => $resource->path(), 'method' => 'patch', 'class' => 'hello-form']) !!}
		<div class="modal-body">
			
			<div class="row">
				<div class="col-lg-12 form-group">
	                {!! Form::label('cliente', 'Nome do cliente *') !!}
	                {!! Form::text('cliente', null, ['class' => 'form-control', 'required']) !!}
	                <span class="form-text">Por favor, informe o nome ou parte do nome do cliente para pesquisar.</span>
	            </div>
			</div>
			<div class="row form-group">
	            <div class="col-lg-12 form-group">
	                {!! Form::label('pago', 'Já está pago? *') !!}
	                {!! Form::select('pago', [
	                    '' => 'Por favor, selecione...', 
	                    0 => 'Não', 
	                    1 => 'Sim', 
	                ], null, ['class' => 'form-control', 'required']) !!}
	                <span class="form-text">Informe se o pedido já foi pago.</span>
	            </div>
			</div>
			<div class="row form-group">
				<div class="col-lg-12 form-group">
					{!! Form::label('forma_pagamento', 'Forma de pagamento') !!}
					{!! Form::select('forma_pagamento', [
						'' => 'Por favor, selecione...', 
					] + Pedroroccon\Farmacia\Entrega::$forma_pagamento_list, null, ['class' => 'form-control']) !!}
					<span class="form-text">Informe a forma de pagamento.</span>
	            </div>
			</div>

			<div class="row">
				<div class="col-lg-6 form-group">
	                {!! Form::label('telefone', 'Telefone/celular') !!}
	                {!! Form::text('telefone', null, ['class' => 'form-control']) !!}
	                <span class="form-text">Informe um número de telefone para este cliente.</span>
	            </div>
	            <div class="col-lg-6 form-group">
	                {!! Form::label('pedido', 'Número do pedido') !!}
	                {!! Form::text('pedido', null, ['class' => 'form-control']) !!}
	                <span class="form-text">Informe o código do pedido referente a esta entrega.</span>
	            </div>
			</div>

			<div class="row">
				<div class="col-lg-12 form-group">
	                {!! Form::label('endereco', 'Endereço *') !!}
	                {!! Form::text('endereco', null, ['class' => 'form-control', 'v-model' => 'endereco', 'required']) !!}
	                <span class="form-text">Informe o endereço referente ao cliente.</span>
	            </div>
			</div>
			<div class="row">
	            <div class="col-lg-5 form-group">
	                {!! Form::label('numero', 'Número *') !!}
	                {!! Form::text('numero', null, ['class' => 'form-control', 'v-model' => 'numero', 'required']) !!}
	                <span class="form-text">Informe o número referente ao endereço.</span>
	            </div>
	            <div class="col-lg-7 form-group">
	                {!! Form::label('bairro', 'Bairro *') !!}
	                {!! Form::text('bairro', null, ['class' => 'form-control', 'v-model' => 'bairro', 'required']) !!}
	                <span class="form-text">Informe o bairro referente ao cliente.</span>
	            </div>
			</div>
			<div class="row">
	            <div class="col-lg-6 form-group">
	                {!! Form::label('cidade', 'Cidade *') !!}
	                {!! Form::text('cidade', ! isset($entrega) ? 'Limeira' : null, ['class' => 'form-control', 'v-model' => 'cidade']) !!}
	                <span class="form-text">Informe a cidade referente ao endereço.</span>
	            </div>
	            <div class="col-lg-6 form-group">
					{!! Form::label('estado', 'Estado *', ['class' => 'control-label']) !!}
					{!! Form::select('estado', ['Por favor, selecione...'] + \Pedroroccon\Localidade\Estado::ordenado()->pluck('titulo', 'sigla')->toArray() + ['EX' => 'Exterior (Entidades estrangeiras)'], ! isset($entrega) ? 'SP' : null, ['class' => 'form-control', 'v-model' => 'estado']) !!}
					<p class="form-text">Especifique o estado referente ao endereço. <span class="text-success">Para entidades estrangeiras, utilizar EX.</span></p>
				</div>
	        </div>

			<div class="row">
	            <div class="col-lg-6 form-group">
	                {!! Form::label('valor', 'Valor do pedido') !!}
	                <div class="input-group">
	                    <div class="input-group-prepend">
	                        <span class="input-group-text">R$</span>
	                    </div>
	                    {!! Form::number('valor', null, ['class' => 'form-control', 'step' => 'any', 'required']) !!}
	                </div>
	                <span class="form-text">Informe o valor total das mercadorias.</span>
	            </div>
	            <div class="col-lg-6 form-group">
	                {!! Form::label('troco', 'Troco para') !!}
	                <div class="input-group">
	                    <div class="input-group-prepend">
	                        <span class="input-group-text">R$</span>
	                    </div>
	                    {!! Form::number('troco', null, ['class' => 'form-control', 'step' => 'any']) !!}
	                </div>
	                <span class="form-text">Informe o valor do troco. <span class="text-success">Deixe zerado caso não seja necessário troco</span>,</span>
	            </div>
	        </div>

	        <div class="row">
	            <div class="col-lg-12 form-group">
	                {!! Form::label('observacao', 'Observações extras') !!}
	                {!! Form::textarea('observacao', null, ['class' => 'form-control', 'rows' => 3]) !!}
	                <span class="form-text">Informe observações extras no campo acima. <span class="text-success">Este campo é opcional</span>.</span>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-lg-6 form-group">
	                {!! Form::label('envio', 'Tipo do envio') !!}
	                {!! Form::select('envio', [
	                    'Motoboy' => 'Motoboy', 
	                ], null, ['class' => 'form-control']) !!}
	                <span class="form-text">Informe o tipo do envio.</span>
	            </div>
	            <div class="col-lg-6 form-group">
	                {!! Form::label('envio_em', 'Enviar em') !!}
	                {!! Form::date('envio_em', isset($entrega->envio_em) ? $entrega->envio_em->format('Y-m-d') : null, ['class' => 'form-control', 'required']) !!}
	                <strong class="form-text text-danger">P.S. Até 16h na mesa do Rodrigo!</strong>
	            </div>
	        </div>
	        <div class="row">
	            <div class="col-lg-12 form-group">
	                {!! Form::label('responsavel', 'Responsável') !!}
	                {!! Form::select('responsavel', [
						'' => 'Por favor, selecione...', 
	                ] + App\User::whereNotIn('email', ['byus@byus.com.br', 'app@ahomeoervas.com.br', 'usuario@usuario.com.br'])->orderBy('name')->pluck('name', 'name')->toArray(), null, ['class' => 'form-control', 'required']) !!}
	                <span class="form-text">Informe o responsável pelo pedido associado a esta entrega.</span>
	            </div>
	        </div>
		</div>
		<div class="modal-footer">
			{!! Form::submit('Editar entrega', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
@endcomponent