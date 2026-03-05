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
        Schema::table('options', function (Blueprint $table) {
            $table->renameColumn('question', 'option_id');
        });

        Schema::table('options', function (Blueprint $table) {
            $table->unsignedBigInteger('option_id')->change();
        });
    }

    public function down(): void
    {
        Schema::table('options', function (Blueprint $table) {
            $table->renameColumn('option_id', 'question');
        });

        Schema::table('options', function (Blueprint $table) {
            $table->text('question')->change();
        });
    }
};
