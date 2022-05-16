<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_bank_question', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams');
            $table->unsignedBigInteger('row_id');
            $table->string('table_name', 50);
            $table->unsignedTinyInteger('number_of_questions')->nullable()->default(null);
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp("updated_at")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_bank_question');
    }
};
