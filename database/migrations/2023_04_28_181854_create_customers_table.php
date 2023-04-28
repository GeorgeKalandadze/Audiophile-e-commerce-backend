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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->char('phone');
            $table->char('address');
            $table->integer('zip_code');
            $table->string('city');
            $table->string('country');
            $table->char('e_money_number');
            $table->char('e_money_pin');
            $table->enum('payment_details', ['e-Money', 'e-Money PIN'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
