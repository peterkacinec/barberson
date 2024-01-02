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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // todo potrebujem toto?
            $table->date('date');
            $table->float('price'); // todo potrebujem toto, alebo staci mat iba na polozkach a tu pocitat SUM
            $table->string('currency')->default('EUR');
            $table->string('status');
            $table->string('payment_type');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('customer_address');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers');
//                ->onDelete('cascade');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');
//                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
