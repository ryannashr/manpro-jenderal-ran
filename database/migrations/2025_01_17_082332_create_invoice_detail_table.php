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
    Schema::create('invoice_detail', function (Blueprint $table) {
        $table->id(); // Primary key (auto increment)
        $table->foreignId('invoice_id')
            ->references('id')->on('invoice')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
        $table->string('deskripsi');
        $table->decimal('harga');
        $table->integer('qty');
        $table->decimal('total');
        $table->timestamps();
    });
}

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {    
        Schema::dropIfExists('invoice_detail');
    }
};
