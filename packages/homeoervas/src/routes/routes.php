<?php

Route::group(['prefix' => config('hello.url' ), 'middleware' => ['web', 'auth']], function () {

    // Relatórios
    Route::get('entrega/relatorio/saida/motoboy', '\Pedroroccon\Farmacia\Controllers\EntregaRelatorioController@saidaMotoboy');
    Route::get('entrega/relatorio/fechamento/gerar', '\Pedroroccon\Farmacia\Controllers\EntregaRelatorioController@fechamentoGerar');
    Route::get('entrega/relatorio/fechamento', '\Pedroroccon\Farmacia\Controllers\EntregaRelatorioController@fechamento');
    Route::get('entrega/relatorio', '\Pedroroccon\Farmacia\Controllers\EntregaRelatorioController@index');
    Route::match(['get', 'post'], 'entrega/relatorio/pendentes-por-data-de-entrega', '\Pedroroccon\Farmacia\Controllers\EntregaRelatorioController@pendentesPorDataDeEntrega');
    Route::match(['get', 'post'], 'entrega/relatorio/pendentes', '\Pedroroccon\Farmacia\Controllers\EntregaRelatorioController@pendentes');
    Route::match(['get', 'post'], 'entrega/fechamento', '\Pedroroccon\Farmacia\Controllers\EntregaController@fechamento');

    Route::resource('entrega/{entrega}/item', '\Pedroroccon\Farmacia\Controllers\EntregaItemController');
    Route::post('entrega/{entrega}/desconcluir', '\Pedroroccon\Farmacia\Controllers\EntregaController@desconcluir');
    Route::post('entrega/{entrega}/concluir', '\Pedroroccon\Farmacia\Controllers\EntregaController@concluir');
    Route::resource('entrega', '\Pedroroccon\Farmacia\Controllers\EntregaController');
});

Route::get('entrega/imprimir/resumo', '\Pedroroccon\Farmacia\Controllers\EntregaController@imprimirResumo');
Route::get('entrega/imprimir', '\Pedroroccon\Farmacia\Controllers\EntregaController@imprimir');

require 'breadcrumbs.php';