<div class="row">
    <div class="col-lg-12 form-group">
        {!! Form::label('titulo', 'Item/produto') !!}
        {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
        <span class="form-text">Informe o título do item/produto. Esta informação irá identificar o produto no sistema.</span>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        {!! Form::label('quantidade', 'Qtde.') !!}
        {!! Form::number('quantidade', null, ['class' => 'form-control', 'step' => 'any', 'min' => 0]) !!}
        <span class="form-text">Informe a quantidade de itens que estão sendo enviados na entrega.</span>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 form-group">
        {!! Form::label('geladeira', 'Geladeira?') !!}
        {!! Form::select('geladeira', [
            0 => 'Não', 
            1 => 'Sim'
        ], null, ['class' => 'form-control']) !!}
        <span class="form-text">Informe se este item precisa ir à geladeira.</span>
    </div>
    <div class="col-lg-6 form-group">
        {!! Form::label('homeopatia', 'Homeopatia?') !!}
        {!! Form::select('homeopatia', [
            0 => 'Não', 
            1 => 'Sim'
        ], null, ['class' => 'form-control']) !!}
        <span class="form-text">Informe se este item é uma homeopatia.</span>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        {!! Form::label('pedido', 'Pedido') !!}
        {!! Form::text('pedido', null, ['class' => 'form-control']) !!}
        <span class="form-text">Informe o número do pedido referente a este item.</span>
    </div>
</div>