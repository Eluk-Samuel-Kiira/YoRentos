<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_estates';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('mysql_estates')->create('estates', function (Blueprint $table) {
            $table->id();
            $table->string('estate')->unique();
            $table->string('slug')->nullable();
            $table->string('uid')->nullable();
            $table->string('landlord_id')->nullable();
            $table->string('broker_id')->nullable();
            $table->string('rental_id')->nullable();
            $table->string('village_id')->nullable();
            $table->string('images')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('video')->nullable();
            $table->longText('description')->nullable();
            $table->string('unit_no')->nullable();
            $table->unsignedBigInteger('status')->default(1);
            $table->unsignedBigInteger('deleted')->default(0);
            $table->unsignedBigInteger('sponsored')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estates');
    }
};
