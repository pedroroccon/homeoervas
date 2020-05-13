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
            $table->string('cliente')->nullable();
            $table->string('telefone')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->char('estado', 2)->nullable();
            $table->string('cep')->nullable();
            $table->decimal('valor', 16, 2)->default(0);
            $table->decimal('valor_pago')->nullable()->default(0);
            $table->dateTime('pago_em')->nullable();
            $table->decimal('troco')->nullable()->default(0);
            $table->string('pedido')->nullable();

            // Envio
            $table->string('envio')->nullable();
            $table->date('envio_em')->nullable();
            $table->string('responsavel')->nullable();
            $table->dateTime('impresso_em')->nullable();

            // Fechamento
            $table->dateTime('fechado_em')->nullable();
            $table->integer('fechado_sequencial')->nullable()->default(1);
            
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