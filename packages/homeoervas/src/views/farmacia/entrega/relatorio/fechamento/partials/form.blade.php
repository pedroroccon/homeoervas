<div class="container-fluid">

    @component('hive::components.card', ['title' => 'Informações do relatório'])

        <div class="row">
            <div class="col-lg-3 form-group">
                {!! Form::label('data', 'Data do fechamento') !!}
                {!! Form::date('data', null, ['class' => 'form-control']) !!}
                <span class="form-text">Informe a data referente a análise do fechamento das entregas.</span>
            </div>
            <div class="col-lg-4 form-group">
                {!! Form::label('ordenar', 'Ordenar por') !!}
                {!! Form::select('ordenar', [
                    'numero_entrega' => 'Número da entrega', 
                    'impresso_em' => 'Data da emissão do impresso', 
                    'valor' => 'Valor', 
                ], null, ['class' => 'form-control']) !!}
                <span class="form-text">Especifique qual é a ordem que você deseja listar os seus registros.</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 form-group">
                {!! Form::label('tipo', 'Tipo do fechamento') !!}
                {!! Form::select('tipo', [
                    'diario' => 'Diário', 
                    'semanal' => 'Semanal', 
                    'motoboy' => 'Fechamento motoboy'
                ], null, ['class' => 'form-control']) !!}
                <span class="form-text">Informe o tipo do fechamento. Fechamento diário irá considerar somente os valores do dia. No fechamento mensal será considerado os valores desde o início até o final da data do fechamento referenciada acima.</span>
            </div>
        </div>

    @endcomponent

    @include('hive::components.form-footer', ['button' => $submit_button_text])

</div>