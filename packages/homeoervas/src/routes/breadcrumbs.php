<?php

// Entrega
Breadcrumbs::register('hello-entrega', function ($b) {
    $b->parent('hello-home');
    $b->push('Entregas', url(config('hello.url') . '/entrega'));
});
Breadcrumbs::register('hello-entrega-create', function ($b) {
    $b->parent('hello-entrega');
    $b->push('Adicionar', url(config('hello.url') . '/entrega/create'));
});
Breadcrumbs::register('hello-entrega-show', function ($b, $entrega) {
    $b->parent('hello-entrega');
    $b->push($entrega->cliente, url($entrega->path()));
});
Breadcrumbs::register('hello-entrega-edit', function ($b, $entrega) {
    $b->parent('hello-entrega-show', $entrega);
    $b->push('Editar', url($entrega->path() . '/edit'));
});

// Entrega - relatórios
Breadcrumbs::register('hello-entrega-relatorio', function ($b) {
    $b->parent('hello-entrega');
    $b->push('Relatórios', url(config('hello.url') . '/entrega/relatorio'));
});

Breadcrumbs::register('hello-entrega-relatorio-semanal', function ($b) {
    $b->parent('hello-entrega-relatorio');
    $b->push('Relatório de entrega semanal', url(config('hello.url') . '/entrega/relatorio/semanal'));
});