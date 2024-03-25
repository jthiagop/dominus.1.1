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
        Schema::create('matrizs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('user_id');

            $table->string('cnpj')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->date('data_cnpj')->nullable();
            $table->date('data_fundacao')->nullable();
            $table->enum('natureza', ['matriz', 'filial'])->nullable();
            $table->timestamps();


            $table->foreign('tenant_id')
                    ->references('id')
                    ->on('tenants')
                    ->onDelete('cascade');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matrizs');
    }
};
