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
            page-break-after: always;
        }

        .container-resumo {
            position: relative;
            width: 100%;
            height: 50%;
            display: flex;
            align-items: center;
        }

        .container-resumo:nth-child(2) {
            border-top: #000 1px dashed;
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

        .btn {
            margin: 20px 0;
            background: #007bff;
            padding: 10px 20px;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            display: inline-block !important;
        }

        .btn:hover {
            background: #025dbd;
        }
        
        .d-print-none {
            display: block;
        }

        @media print {
            .d-print-none { display: none !important; }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table th {
            text-align: left;
        }

        table td, table th {
            padding: 0 5px;
            line-height: 18px;
            border: #000 1px solid;
        }

        table tfoot {
            font-weight: bold;
        }

        .text-right { text-align: right; }
        
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
                        <span style="font-size: 15px;"><strong>Valor:</strong> R$ {{ number_format($entrega->valor, 2, ',', '.') }}{!! $entrega->estaPago() ? ' <strong>(PAGO)</strong>' : null !!} <span style="display: inline-block; float: right;">{{ ! empty($entrega->envio_em) ? $entrega->envio_em->format('d/m/Y') : 'Data não informada' }}</span></span>
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

    <div class="container">
        @for($i = 1; $i <= 2; $i++)
            <div class="container-resumo">
                <table class="table">
                    <tbody>
                        <tr>
                            <td colspan="2">{{ $i }}ª via - <strong>Período {{ $entregas->first()->fechado_sequencial }} - De {{ $entregas->first()->impresso_em->format('d/m/Y H:i') }} até {{ $entregas->last()->impresso_em->format('d/m/Y H:i') }}</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Entregas no período</strong></td>
                            <td class="text-right">{{ $entregas->count() }}</td>
                        </tr>
                        <tr>
                            <td><strong>Cartão (crédito/débito)</strong></td>
                            <td class="text-right">R$ {{ number_format($entregas->whereIn('forma_pagamento', ['Cartão de crédito', 'Cartão de débito'])->sum('valor_ou_troco'), 2, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Dinheiro</strong></td>
                            <td class="text-right">R$ {{ number_format($entregas->where('forma_pagamento', 'Dinheiro')->sum('valor_ou_troco'), 2, ',', '.') }}</td>
                        </tr>
                        <tr style="font-size: 16px;">
                            <td><strong>Valor total</strong></td>
                            <td class="text-right"><strong>R$ {{ number_format($entregas->sum('valor_ou_troco'), 2, ',', '.') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            </div>
        @endfor
    </div>
</body>
</html>