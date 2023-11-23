<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The database connection that should be used by the migration.
     *
     * @var string
     */
    protected $connection = 'mysql_locations';
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('mysql_locations')->create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique();
            $table->string('district')->unique();
            $table->string('country_id');
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
        Schema::dropIfExists('districts');
    }
};
