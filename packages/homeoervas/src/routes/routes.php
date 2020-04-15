<?php

Route::group(['prefix' => config('hello.url' ), 'middleware' => ['web', 'auth']], function () {
    Route::match(['get', 'post'], 'entrega/relatorio/semanal', '\Pedroroccon\Farmacia\Controllers\EntregaRelatorioController@semanal');
    Route::get('entrega/relatorio', '\Pedroroccon\Farmacia\Controllers\EntregaRelatorioController@index');
    Route::resource('entrega/{entrega}/item', '\Pedroroccon\Farmacia\Controllers\EntregaItemController');
    Route::post('entrega/{entrega}/concluir', '\Pedroroccon\Farmacia\Controllers\EntregaController@concluir');
    Route::resource('entrega', '\Pedroroccon\Farmacia\Controllers\EntregaController');
});

Route::get('entrega/imprimir', '\Pedroroccon\Farmacia\Controllers\EntregaController@imprimir');

require 'breadcrumbs.php';