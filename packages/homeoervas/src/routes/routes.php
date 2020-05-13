<?php

Route::group(['prefix' => config('hello.url' ), 'middleware' => ['web', 'auth']], function () {

    // Relatórios
    Route::match(['get', 'post'], 'entrega/relatorio/fechamento', '\Pedroroccon\Farmacia\Controllers\EntregaRelatorioController@fechamento');
    Route::get('entrega/relatorio', '\Pedroroccon\Farmacia\Controllers\EntregaRelatorioController@index');

    Route::match(['get', 'post'], 'entrega/fechamento', '\Pedroroccon\Farmacia\Controllers\EntregaController@fechamento');

    Route::resource('entrega/{entrega}/item', '\Pedroroccon\Farmacia\Controllers\EntregaItemController');
    Route::post('entrega/{entrega}/concluir', '\Pedroroccon\Farmacia\Controllers\EntregaController@concluir');
    Route::resource('entrega', '\Pedroroccon\Farmacia\Controllers\EntregaController');
});

Route::get('entrega/imprimir', '\Pedroroccon\Farmacia\Controllers\EntregaController@imprimir');

require 'breadcrumbs.php';