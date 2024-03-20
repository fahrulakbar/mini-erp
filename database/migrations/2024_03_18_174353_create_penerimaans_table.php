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
        Schema::create('penerimaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_po');
            $table->integer('no_penerimaan');
            $table->string('nama_sup');
            $table->text('alamat_sup');
            $table->string('no_so');
            $table->string('tanggal_diterima');
            $table->unsignedBigInteger('id_barang');
            $table->string('qty_barang');
            $table->string('status_penerimaan');
            $table->timestamps();

            $table->foreign('id_po')->references('id')->on('purchase_orders')->onDelete('cascade');
            $table->foreign('id_barang')->references('id')->on('inventories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimaans');
    }
};
