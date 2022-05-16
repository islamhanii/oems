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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses');
            $table->string('name', 100);
            $table->text('description');
            $table->unsignedTinyInteger('number_of_questions')->default(0);
            $table->unsignedTinyInteger('duration_minutes')->default(30);
            $table->unsignedTinyInteger('totle')->default(100);
            $table->boolean('diffculty')->default(0);
            $table->boolean('show')->default(0);
            $table->timestamp("started_at");
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
        Schema::dropIfExists('exams');
    }
};
