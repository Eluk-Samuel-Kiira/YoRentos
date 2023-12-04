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
        Schema::connection('mysql_estates')->create('units', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('uid');
            $table->string('slug');
            $table->string('estate_id')->nullable();
            $table->string('estate_uid')->nullable();
            $table->string('rental_id')->nullable();
            $table->string('room_no')->nullable();
            $table->string('duration_id')->nullable();
            $table->string('price')->nullable();
            $table->string('square_footage')->nullable();
            $table->string('resources')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('status')->default(1);
            $table->unsignedBigInteger('deleted')->default(0);
            $table->unsignedBigInteger('sponsored')->default(0);
            $table->string('tenant_id')->nullable();
            $table->string('lease_start')->nullable();
            $table->string('lease_stop')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
