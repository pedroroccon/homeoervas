<?php

namespace Pedroroccon\Farmacia\Seeders;

use Illuminate\Database\Seeder;

use Pedroroccon\Hello\Empresa;

class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'titulo' => 'Farmácia Homeo Ervas', 
            'razao_social' => 'Farmácia Homeo-Ervas Ltda EPP', 
            'fantasia' => 'Farmácia Homeo Ervas', 
            'cnpj' => '04247439000174', 
            'inscricao_estadual' => '', 
            'inscricao_municipal' => '', 
            'cep' => '13480190', 
            'endereco' => 'Rua Conselheiro Saraiva', 
            'numero' => '106', 
            'bairro' => 'Centro', 
            'complemento' => '', 
            'cidade' => 'Limeira', 
            'estado' => 'SP', 
            'telefone' => '1937012858', 
            'email' => 'duvidas@ahomeoervas.com.br', 
        ]);
    }
}