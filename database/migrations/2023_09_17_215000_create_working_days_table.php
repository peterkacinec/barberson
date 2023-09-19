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
        Schema::create('working_days', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->enum('day',['Mo', 'Tu', 'W', 'Th', 'F', 'Sa', 'So']);
            $table->string('from');
            $table->string('to');
            $table->string('available');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers');
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_days');
    }
};
