<div class="container-fluid" id="form">
    @component('hive::components.card', ['title' => 'Informações da entrega'])
        
        <div class="row">
            <div class="col-lg-9 form-group">
                {!! Form::label('cliente', 'Nome do cliente *') !!}
                {!! Form::text('cliente', null, ['class' => 'form-control']) !!}
                <span class="form-text">Por favor, informe o nome ou parte do nome do cliente para pesquisar.</span>
            </div>
            <div class="col-lg-3 form-group">
                {!! Form::label('pago', 'Já está pago? *') !!}
                {!! Form::select('pago', [
                    '' => 'Por favor, selecione...', 
                    0 => 'Não', 
                    1 => 'Sim', 
                ], null, ['class' => 'form-control']) !!}
                <span class="form-text">Informe se o pedido já foi pago.</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 form-group">
                {!! Form::label('telefone', 'Telefone/celular') !!}
                {!! Form::text('telefone', null, ['class' => 'form-control']) !!}
                <span class="form-text">Informe um número de telefone para este cliente.</span>
            </div>
            <div class="col-lg-3 form-group">
                {!! Form::label('pedido', 'Número do pedido') !!}
                {!! Form::text('pedido', null, ['class' => 'form-control']) !!}
                <span class="form-text">Informe o código do pedido referente a esta entrega.</span>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-lg-3 form-group">
                {!! Form::label('cep', 'CEP') !!}
                <div class="input-group">
                    {!! Form::text('cep', null, ['class' => 'form-control', 'v-model' => 'cep']) !!}
                    <div class="input-group-append">
                        <span class="input-group-text" v-if="loadingCep"><i class="fas fa-spinner fa-fw fa-pulse"></i></span>
                        <button v-on:click.prevent="buscarCep()" class="btn btn-outline-secondary"><i class="fas fa-search fa-fw"></i></button>
                    </div>
                </div>
                <span class="form-text">Por favor, informe o CEP. <span class="text-success">ALT + N para buscar</span></span>
            </div>
            <div class="col-lg-4 form-group">
                {!! Form::label('endereco', 'Endereço *') !!}
                {!! Form::text('endereco', null, ['class' => 'form-control', 'v-model' => 'endereco']) !!}
                <span class="form-text">Informe o endereço referente ao cliente.</span>
            </div>
            <div class="col-lg-2 form-group">
                {!! Form::label('numero', 'Número *') !!}
                {!! Form::text('numero', null, ['class' => 'form-control', 'v-model' => 'numero']) !!}
                <span class="form-text">Informe o número referente ao endereço.</span>
            </div>
            <div class="col-lg-3 form-group">
                {!! Form::label('bairro', 'Bairro *') !!}
                {!! Form::text('bairro', null, ['class' => 'form-control', 'v-model' => 'bairro']) !!}
                <span class="form-text">Informe o bairro referente ao cliente.</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 form-group">
                {!! Form::label('cidade', 'Cidade *') !!}
                {!! Form::text('cidade', null, ['class' => 'form-control', 'v-model' => 'cidade']) !!}
                <span class="form-text">Informe a cidade referente ao endereço.</span>
            </div>
            <div class="col-lg-3 form-group">
				{!! Form::label('estado', 'Estado *', ['class' => 'control-label']) !!}
				{!! Form::select('estado', ['Por favor, selecione...'] + \Pedroroccon\Localidade\Estado::ordenado()->pluck('titulo', 'sigla')->toArray() + ['EX' => 'Exterior (Entidades estrangeiras)'], null, ['class' => 'form-control', 'v-model' => 'estado']) !!}
				<p class="form-text">Especifique o estado referente ao endereço. <span class="text-success">Para entidades estrangeiras, utilizar EX.</span></p>
			</div>
        </div>

        <hr>
        
        <div class="row">
            <div class="col-lg-3 form-group">
                {!! Form::label('valor', 'Valor do pedido') !!}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">R$</span>
                    </div>
                    {!! Form::number('valor', null, ['class' => 'form-control', 'step' => 'any']) !!}
                </div>
                <span class="form-text">Informe o valor total das mercadorias.</span>
            </div>
            <div class="col-lg-3 form-group">
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

    @endcomponent

    @component('hive::components.card', ['title' => 'Itens na entrega'])
        <div v-for="(item, index) in itens">
            <div class="row">
                <div class="col-lg-4 form-group">
                    <label :for="'itens[' + index + '][titulo]'">Item/produto</label>
                    <div class="input-group">
                        <div class="input-group-prepend" v-if="index > 0">
                            <button class="btn btn-danger" v-on:click.prevent="deleteItem(index)"><i class="fas fa-trash-alt fa-fw"></i></button>
                        </div>
                        <input type="text" :name="'itens[' + index + '][titulo]'" class="form-control">
                    </div>
                    <span class="form-text">Informe o título do produto.</span>
                </div>
                <div class="col-lg-2 form-group">
                    <label :for="'itens[' + index + '][quantidade]'">Qtde.</label>
                    <input type="number" step="any" min="0" :name="'itens[' + index + '][quantidade]'" class="form-control">
                    <span class="form-text">Informe a quantidade que será enviada.</span>
                </div>
                <div class="col-lg-2 form-group">
                    <label :for="'itens[' + index + '][geladeira]'">Geladeira?</label>
                    <select :name="'itens[' + index + '][geladeira]'" class="form-control">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                    <span class="form-text">Item precisa ser armazenado na geladeira?</span>
                </div>
                <div class="col-lg-2 form-group">
                    <label :for="'itens[' + index + '][homeopatia]'">Homeopatia?</label>
                    <select :name="'itens[' + index + '][homeopatia]'" class="form-control">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                    <span class="form-text">Item é homeopatia?</span>
                </div>
                <div class="col-lg-2 form-group">
                    <label :for="'itens[' + index + '][pedido]'">Pedido</label>
                    <input type="text" :name="'itens[' + index + '][pedido]'" class="form-control">
                    <span class="form-text">Informe o número do pedido referente ao item.</span>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <a href="#" class="btn btn-sm btn-primary" v-on:click.prevent="createItem()">Adicionar item</a>
            </div>
        </div>
    @endcomponent

    @component('hive::components.card', ['title' => 'Informações adicionais'])
        <div class="row">
            <div class="col-lg-12 form-group">
                {!! Form::label('observacao', 'Observações extras') !!}
                {!! Form::textarea('observacao', null, ['class' => 'form-control', 'rows' => 3]) !!}
                <span class="form-text">Informe observações extras no campo acima. <span class="text-success">Este campo é opcional</span>.</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 form-group">
                {!! Form::label('envio', 'Tipo do envio') !!}
                {!! Form::select('envio', [
                    '' => 'Por favor, selecione...', 
                    'PAC' => 'PAC', 
                    'SEDEX' => 'SEDEX', 
                ], null, ['class' => 'form-control']) !!}
                <span class="form-text">Informe o tipo do envio.</span>
            </div>
            <div class="col-lg-2 form-group">
                {!! Form::label('envio_hoje', 'Enviar hoje? *') !!}
                {!! Form::select('envio_hoje', [
                    '' => 'Selecione...', 
                    0 => 'Não', 
                    1 => 'Sim', 
                ], null, ['class' => 'form-control']) !!}
                <span class="form-text text-danger">P.S. Até 16h na mesa do Rodrigo!</span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                {!! Form::label('responsavel', 'Responsável') !!}
            </div>
        </div>
        @foreach(App\User::all() as $usuario)
            <div class="row">
                <div class="col-lg-12 form-group">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="usuario_{{ $usuario->id }}" name="responsavel" class="custom-control-input" value="{{ $usuario->name }}">
                        <label class="custom-control-label" for="usuario_{{ $usuario->id }}">{{ $usuario->name }}</label>
                        <span class="form-text">{{ $usuario->email }}</span>
                    </div>
                </div>
            </div>
        @endforeach        
    @endcomponent

    @include('hive::components.form-footer', ['button' => $submit_button_text])
</div>

@section('script')
@parent
<script type="application/javascript">
        const form = new Vue({
            el: '#form', 
            data: {
                cep: '', 
                endereco: '', 
                numero: '', 
                bairro: '', 
                cidade: 'Limeira', 
                estado: 'SP', 
                complemento: '', 
                loadingCep: false, 
                itens: [{
                    titulo: null, 
                    quantidade: null, 
                    pedido: null
                }], 
            }, 
            methods: {
                createItem: function() {
                    console.log('Creating item...');
                    this.itens.push({
                        titulo: null
                    });
                }, 
                deleteItem: function(index) {
                    console.log('Deleting item...');
                    this.itens.splice(index, 1);
                }, 
                buscarCep: function() {
                    let vm = this;
                    vm.loadingCep = true;
                    console.log('Buscando CEP...');
                    axios.get('https://viacep.com.br/ws/' + this.cep + '/json/').then(function (response) {
                        console.log(response.data);
                        vm.endereco = response.data.logradouro;
                        vm.bairro = response.data.bairro;
                        vm.cidade = response.data.localidade;
                        vm.estado = response.data.uf;
                        vm.complemento = response.data.complemento;
                        vm.loadingCep = false;
                        $('#numero').focus();
                    })
                }
            }, 
            mounted: function() {
                this.$nextTick(function() {
                    window.addEventListener('keyup', event => {
                        if (event.altKey && event.keyCode == 78) { this.buscarCep(); }
                    });
                });
            }
        })
</script>
@endsection