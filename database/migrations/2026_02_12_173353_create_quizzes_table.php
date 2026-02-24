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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('branch_id')->index();
            $table->unsignedBigInteger('topic_id')->index();

            $table->text('question');

            $table->string('option_1');
            $table->string('option_2');
            $table->string('option_3')->nullable();
            $table->string('option_4')->nullable();

            $table->string('correct_option');

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->timestamps();

            //* Foreign Keys
            $table->foreign('topic_id')
                ->references('id')
                ->on('topic_names')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
