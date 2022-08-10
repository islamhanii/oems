<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_bank', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams');
            $table->foreignId('bank_id')->constrained('banks');
            $table->unsignedTinyInteger('number_of_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_bank');
    }
}
