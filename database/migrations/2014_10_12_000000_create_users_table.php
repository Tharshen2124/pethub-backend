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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('permission_level', ['1', '2', '3']);
            $table->string('image');
            $table->float('deposit_range');
            $table->string('service_type');
            $table->text('description');
            $table->string('contact_number');
            $table->time('opening_hour');
            $table->time('closing_hour');
            $table->string('bank_name');
            $table->integer('beneficiary_acc_number');
            $table->string('beneficiary_name');
            $table->string('qr_code_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
