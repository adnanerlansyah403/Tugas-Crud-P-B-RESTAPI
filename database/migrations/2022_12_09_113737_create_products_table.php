<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->nullable();
            $table->text('deskripsi');
            $table->integer('harga')->default(0);
            $table->integer('harga_diskon')->default(0)->nullable();
            $table->decimal('diskon')->default(0)->nullable();
            $table->string('foto_name')->nullable();
            $table->string('foto_url')->nullable();
            $table->boolean('kondisi')->default(1);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('products');
    }
};
