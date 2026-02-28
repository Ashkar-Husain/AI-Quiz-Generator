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
        Schema::rename('topic_names', 'topics');
        Schema::rename('quizzes', 'options');
    }

    public function down(): void
    {
        Schema::rename('topics', 'topic_names');
        Schema::rename('options', 'quizzes');
    }
};
