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
Breadcrumbs::register('hello-entrega-fechamento', function ($b) {
    $b->parent('hello-entrega');
    $b->push('Fechamento de entregas');
});

// Entrega - relatórios
Breadcrumbs::register('hello-entrega-relatorio', function ($b) {
    $b->parent('hello-entrega');
    $b->push('Relatórios', url(config('hello.url') . '/entrega/relatorio'));
});
Breadcrumbs::register('hello-entrega-relatorio-fechamento', function ($b) {
    $b->parent('hello-entrega-relatorio');
    $b->push('Relatório de fechamento de entregas', url(config('hello.url') . '/entrega/relatorio/fechamento'));
});
Breadcrumbs::register('hello-entrega-relatorio-pendentes', function ($b) {
    $b->parent('hello-entrega-relatorio');
    $b->push('Relatório de entregas pendentes', url(config('hello.url') . '/entrega/relatorio/pendentes'));
});
Breadcrumbs::register('hello-entrega-relatorio-pendentes-por-data-de-entrega', function ($b) {
    $b->parent('hello-entrega-relatorio');
    $b->push('Relatório de entregas pendentes por data de entrega', url(config('hello.url') . '/entrega/relatorio/pendentes-por-data-de-entrega'));
});