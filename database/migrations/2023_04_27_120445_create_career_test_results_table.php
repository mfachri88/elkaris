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
        Schema::create('career_test_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('software_developer')->default(0);
            $table->integer('data_scientist')->default(0);
            $table->integer('network_engineer')->default(0);
            $table->integer('ui_ux_designer')->default(0);
            $table->integer('cybersecurity_analyst')->default(0);
            $table->integer('it_consultant')->default(0);
            
            $table->string('result');
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            // Add foreign key constraint only if users table exists
            if (Schema::hasTable('users')) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_test_results');
    }
};
