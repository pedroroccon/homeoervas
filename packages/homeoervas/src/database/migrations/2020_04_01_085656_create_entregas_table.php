<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero_entrega')->nullable()->default(0);
            $table->string('cliente');
            $table->string('telefone')->nullable();
            $table->string('endereco');
            $table->string('numero');
            $table->string('bairro');
            $table->string('cidade');
            $table->char('estado', 2);
            $table->string('cep')->nullable();
            $table->decimal('valor', 16, 2)->default(0);
            $table->decimal('valor_pago')->nullable()->default(0);
            $table->dateTime('pago_em')->nullable();
            $table->decimal('troco')->nullable()->default(0);
            $table->string('pedido')->nullable();
            // $table->integer('itens')->nullable()->default(0);
            // $table->integer('homeopatias')->nullable()->default(0);
            // $table->string('itens_geladeira')->nullable()->default(0);

            // Envio
            $table->string('envio')->nullable();
            $table->date('envio_em')->nullable();
            $table->string('responsavel');
            $table->dateTime('impresso_em')->nullable();
            
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entregas');
    }
}