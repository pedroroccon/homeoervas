<?php

use Illuminate\Database\Seeder;
use App\User;
use Pedroroccon\Farmacia\Entrega;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       User::create([
           'name' => 'Farmácia Homeoervas', 
           'email' => 'app@ahomeoervas.com.br', 
           'type' => 'r', 
           'password' => bcrypt('secret'), 
       ]);

       Artisan::call('db:seed', [
            '--class' => '\Pedroroccon\Hello\Seeders\PermissaoTableSeeder',
        ]);
        Artisan::call('db:seed', [
            '--class' => '\Pedroroccon\Hello\Seeders\UsersTableSeeder',
        ]);
        Artisan::call('db:seed', [
            '--class' => '\Pedroroccon\Hello\Seeders\EmpresasTableSeeder',
        ]);

        Artisan::call('hive-localidade:seed');

        Entrega::create([
            'cliente' => 'Pedro Henrique Roccon', 
            'telefone' => '19999258402', 
            'endereco' => 'Rua 07 CJ', 
            'numero' => '987', 
            'bairro' => 'Cidade Jardim', 
            'cidade' => 'Rio Claro', 
            'estado' => 'SP', 
            'cep' => '13501080', 
            'valor' => 198.90, 
            'valor_pago' => null, 
            'troco' => 200.00, 
            'pedido' => 'OSP456846', 
            // 'itens' => 3, 
            // 'homeopatias' => 1, 
            // 'itens_geladeira' => 1, 
            'envio' => 'SEDEX', 
            'envio_em' => today(), 
            'responsavel' => 'BYUS Tecnologia', 
            'impresso_em' => null, 
            'observacao' => null, 
        ]);
    }
}
