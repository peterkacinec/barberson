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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('ico');
            $table->string('vat')->nullable();
            $table->string('iban')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('street');
            $table->string('house_number');
            $table->string('city');
            $table->string('zip');
            $table->string('country');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
