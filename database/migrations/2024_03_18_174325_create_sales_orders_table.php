<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('no_so')->unique();
            $table->string('nama_customer');
            $table->text('alamat_customer');
            $table->string('status_so');
            $table->date('date_so');
            $table->unsignedBigInteger('id_barang');
            $table->integer('qty_barang');
            $table->timestamps();

            $table->foreign('id_barang')->references('id')->on('inventories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
