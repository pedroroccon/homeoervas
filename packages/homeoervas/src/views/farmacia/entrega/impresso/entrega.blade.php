<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impresso</title>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font: normal 16px sans-serif;
            line-height: 1.5rem;
        }

        span { display: block; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td {
            padding: 10px;
            border: #ddd 1px dotted;
            min-height: 50%;
        }

        .container {
            position: relative;
            margin: 0 auto;
            width: 595px;
            height: 842px;
        }

        .container-row {
            display: flex;
            flex-wrap: wrap;
            max-width: 100%;
        }

        .entrega-container {
            position: relative;
            padding: 10px;
            width: 50%;
            max-width: 50%;
            height: auto;
            border: #000 1px solid;
            box-sizing: border-box;
            display: table-cell;
/*            display: flex;
            align-items: center;
            justify-content: middle;*/
        }

        hr {
            border: none;
            border-top: #000 1px solid;
        }

        .pedido {
            position: absolute;
            top: 5px;
            right: 10px;
            width: auto;
            height: auto;
            font-weight: bold;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="container-row">
            @foreach($entregas as $entrega)
                <div class="entrega-container">
                    <div class="pedido"><span>E. {{ $entrega->numero_entrega }}</span></div>
                    <div>
                        <strong style="font-size: 18px;">{{ $entrega->cliente }}</strong>
                        <span>{{ $entrega->endereco }}, Nº {{ $entrega->numero }} - {{ $entrega->bairro }}, {{ $entrega->cidade }}/{{ $entrega->estado }}</span>
                        <span>
                            <strong>Nº da entrega:</strong> {{ $entrega->pedido ?? 'Não informado' }}<br>
                            <strong>Telefone:</strong> {{ $entrega->telefone ?? 'Não informado' }}
                        </span>
                        <span style="font-size: 15px;"><strong>Valor:</strong> R$ {{ number_format($entrega->valor, 2, ',', '.') }}{!! $entrega->estaPago() ? ' <strong>(PAGO)</strong>' : null !!}</span>
                        {!! ! empty($entrega->troco) ? '<span><strong>Troco:</strong> R$ ' . number_format($entrega->troco, 2, ',', '.') . '</span>' : null !!}
                        <hr>
                        @foreach($entrega->itens as $item)
                            <span><strong>{{ $item->titulo }}</strong>: {{ number_format($item->quantidade, 0, ',', '.') }} un.</span>
                        @endforeach

                        @if ( ! empty($entrega->observacao))
                            <hr>
                            <span><strong>OBS:</strong> {{ nl2br($entrega->observacao) }}</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>