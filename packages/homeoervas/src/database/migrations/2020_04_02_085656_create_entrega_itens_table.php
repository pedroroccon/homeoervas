<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntregaItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrega_itens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('entrega_id');
            $table->string('titulo');
            $table->decimal('quantidade', 16, 2)->default(1);
            $table->boolean('homeopatia')->nullable()->default(0);
            $table->boolean('geladeira')->nullable()->default(0);
            $table->string('pedido')->nullable();
            $table->timestamps();

            // Foreign
            $table->foreign('entrega_id')->references('id')->on('entregas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrega_itens');
    }
}