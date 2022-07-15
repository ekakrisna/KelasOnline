<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('file_id')->nullable();
            $table->string('name');
            $table->string('email', 191);
            $table->dateTime('email_verified_at')->nullable();
            $table->string('password', 191);
            $table->text('description')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('file_id', 'teachers_ibfk_1')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
