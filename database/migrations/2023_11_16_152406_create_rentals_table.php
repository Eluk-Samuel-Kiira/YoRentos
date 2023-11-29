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
        Schema::connection('mysql_estates')->create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('rentals');
    }
};
