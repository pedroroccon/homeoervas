<!DOCTYPE html>
<html lang="pt-br">
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
            font: normal 10px sans-serif;
            line-height: 1.5rem;
        }

        span { display: block; margin: 4px 0; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
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

        .container {
            position: relative;
            margin: 20px auto 0 auto;
            width: 595px;
            height: 842px;
        }

        .text-right {
            text-align: right;
        }
       
        hr {
            border: none;
            border-top: #000 1px solid;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h1>Resumo das entregas</h1>
        <span>Período {{ $entregas->first()->fechado_sequencial }} - De {{ $entregas->first()->impresso_em->format('d/m/Y H:i') }} até {{ $entregas->last()->impresso_em->format('d/m/Y H:i') }}</span>
        
        @for($i = 1; $i <= 2; $i++)
        <table>
            <thead>
                <tr>
                    <th colspan="4">{{ $i }}ª via</th>
                </tr>
                <tr>
                    <th class="text-right">Nº</th>
                    <th>Cliente</th>
                    <th>Forma de pagamento</th>
                    <th class="text-right">Troco</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entregas as $entrega)
                    <tr>
                        <td class="text-right">{{ $entrega->numero_entrega }}</td>
                        <td>{{ $entrega->cliente }}</td>
                        <td>{{ $entrega->forma_pagamento }}</td>
                        <td class="text-right">R$ {{ number_format($entrega->troco, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Entregas: {{ $entregas->count() }}</td>
                    <td class="text-right">R$ {{ number_format($entregas->sum('troco'), 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
        <hr>
        @endfor
    </div>
</body>
</html>