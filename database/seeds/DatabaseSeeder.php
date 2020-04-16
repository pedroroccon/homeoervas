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
        $faker = \Faker\Factory::create('pt_BR');

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
            '--class' => '\Pedroroccon\Farmacia\Seeders\EmpresaTableSeeder',
        ]);

        Artisan::call('hive-localidade:seed');

        // Populando entregas na semana passada
        for ($i = 0; $i <= 10; $i++) {

            $data = now()->startOfWeek();
            $data->subDays(mt_rand(2, 4));
            
            // Verifica se devemos colocar a entrega
            // no período da manhã ou tarde.
            $data->hour = ($faker->boolean) ? 14 : 9;

            Entrega::create([
                'cliente' => $faker->name, 
                'telefone' => $faker->numerify('###########'), 
                'endereco' => $faker->streetName, 
                'numero' => mt_rand(100, 9999), 
                'bairro' => $faker->randomElement(['Centro', 'Jardins', 'Aurora']), 
                'cidade' => $faker->randomElement(['Rio Claro', 'Araras', 'Cordeirópolis']), 
                'estado' => 'SP', 
                'cep' => mt_rand(10000000, 99999999), 
                'valor' => mt_rand(10, 500), 
                'troco' => 0, 
                'pedido' => $faker->bothify('###-#######-#'), 
                'envio' => $faker->randomElement(['SEDEX', 'PAC']), 
                'envio_em' => $data->format('Y-m-d'), 
                'responsavel' => $faker->name, 
                'impresso_em' => $data->format('Y-m-d H:i:s'), 
                'observacao' => 'Entrega realizada na semana passada, na data de ' . $data->format('d/m/Y'), 
                'created_at' => $data->format('Y-m-d H:i:s'), 
            ]);
        }

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
