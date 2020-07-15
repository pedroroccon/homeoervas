<?php

use Faker\Generator as Faker;
use Pedroroccon\Farmacia\Entrega;

$factory->define(Entrega::class, function (Faker $faker) {

    return [
        'cliente' => $faker->name, 
        'endereco' => $faker->streetName, 
        'numero' => mt_rand(1, 9999), 
        'bairro' => $faker->randomElement(['Jardins', 'Moema', 'Mococa', 'Estádio', 'Centro', 'Santana']), 
        'cidade' => $faker->randomElement(['Limeira', 'Rio Claro', 'São Carlos', 'Santa Gertrudes', 'Araras']), 
        'estado' => 'SP', 
        'cep' => mt_rand(10000000, 99999999), 
        'valor' => mt_rand(1, 1000), 
        'pedido' => $faker->bothify('#########'), 
        'itens' => $faker->randomDigit, 
        'homeopatias' => $faker->randomDigit, 
        'responsavel' => $faker->randomElement(['João', 'Maria', 'Alice', 'Bruna', 'Carol', 'Eduardo', 'Pedro', 'Valdir']), 
    ];

});