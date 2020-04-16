<div class="container-fluid">

    @component('hive::components.card', ['title' => 'Informações do relatório'])

        <div class="row">
            <div class="col-lg-3 form-group">
                {!! Form::label('inicio', 'Data inicial') !!}
                {!! Form::date('inicio', null, ['class' => 'form-control']) !!}
                <span class="form-text">Informe a data inicial de análise.</span>
            </div>

            <div class="col-lg-3 form-group">
                {!! Form::label('termino', 'Data de término') !!}
                {!! Form::date('termino', null, ['class' => 'form-control']) !!}
                <span class="form-text">Informe a data de término da análise.</span>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                {!! Form::label('ordenar', 'Ordenar por') !!}
                {!! Form::select('ordenar', [
                    'impresso_em' => 'Data da emissão do impresso', 
                    'numero_entrega' => 'Número da entrega (semanal)', 
                    'valor' => 'Valor', 
                ], null, ['class' => 'form-control']) !!}
                <span class="form-text">Especifique qual é a ordem que você deseja listar os seus registros.</span>
            </div>
        </div>

    @endcomponent

    @include('hive::components.form-footer', ['button' => $submit_button_text])

</div>