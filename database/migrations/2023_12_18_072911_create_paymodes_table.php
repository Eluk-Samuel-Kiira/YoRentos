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
        Schema::connection('mysql_payments')->create('paymodes', function (Blueprint $table) {
            $table->id();
            $table->string('pay_mode')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_name')->nullable();
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
        Schema::dropIfExists('paymodes');
    }
};
