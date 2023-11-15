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
        Schema::create('company_has_c_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('c_user_id');
            $table->unsignedBigInteger('company_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('c_user_id')
                ->references('id')
                ->on('c_users');
//                ->onDelete('cascade');

            $table->foreign('company_id')
                ->references('id')
                ->on('companies');
//                ->onDelete('cascade');
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
