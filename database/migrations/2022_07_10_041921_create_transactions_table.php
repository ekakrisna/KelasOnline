<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('class_id');
            $table->integer('class_type_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('payment_method_id');
            $table->dateTime('class_date');
            $table->integer('how_many_hours');
            $table->decimal('total_price', 10, 0);
            $table->enum('status_payment', ['0', '1'])->nullable();
            $table->decimal('latitude', 10, 0)->nullable();
            $table->decimal('longitude', 10, 0)->nullable();
            $table->string('note', 191)->nullable();
            $table->timestamps();

            $table->foreign('class_id', 'transactions_ibfk_1')->references('id')->on('sessions');
            $table->foreign('class_type_id', 'transactions_ibfk_2')->references('id')->on('session_types');
            $table->foreign('user_id', 'transactions_ibfk_3')->references('id')->on('users');
            $table->foreign('payment_method_id', 'transactions_ibfk_4')->references('id')->on('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
