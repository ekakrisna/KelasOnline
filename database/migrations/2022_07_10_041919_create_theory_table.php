<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theory', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('teacher_id')->nullable();
            $table->string('name_id');
            $table->string('name_en');
            $table->text('description_id');
            $table->text('description_en');
            $table->integer('file_id')->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('file_id', 'theory_ibfk_1')->references('id')->on('files');
            $table->foreign('teacher_id', 'theory_ibfk_2')->references('id')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theory');
    }
}
