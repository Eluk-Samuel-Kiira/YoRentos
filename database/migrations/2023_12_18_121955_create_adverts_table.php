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
        Schema::connection('mysql_payments')->create('adverts', function (Blueprint $table) {
            $table->id();
            $table->string('duration')->nullable();
            $table->string('price')->nullable();
            $table->string('txn_ref')->nullable();
            $table->string('estate_id')->nullable();
            $table->string('landlord_id')->nullable();
            $table->unsignedBigInteger('status')->default(1);
            $table->unsignedBigInteger('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adverts');
    }
};
