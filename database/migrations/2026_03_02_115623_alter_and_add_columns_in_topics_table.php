<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration {

    public function up(): void
    {
        Schema::table('topics', function (Blueprint $table) {

            // MODIFY existing
            $table->string('branch_id', 20)->change();
            $table->string('topic_name', 100)->change();
            $table->string('created_by', 50)->nullable()->change();
            $table->string('updated_by', 50)->nullable()->change();

            // ADD new
            $table->string('subject', 100)->nullable()->after('topic_name');
            $table->unsignedTinyInteger('difficulty_id')->nullable()->after('subject');
            $table->text('topic_description')->nullable()->after('difficulty_id');
            $table->unsignedInteger('taken_count')->default(1)->after('topic_description');
            $table->decimal('rating', 3, 2)->default(0)->after('taken_count');
            $table->string('icon', 50)->nullable()->after('rating');
        });
    }

    public function down(): void
    {
        Schema::table('topics', function (Blueprint $table) {

            // revert modified
            $table->string('branch_id', 255)->change();
            $table->string('topic_name', 255)->change();
            $table->string('created_by', 255)->nullable()->change();
            $table->string('updated_by', 255)->nullable()->change();

            // DROP added columns
            $table->dropColumn([
                'subject',
                'difficulty_id',
                'topic_description',
                'taken_count',
                'rating',
                'icon'
            ]);
        });
    }
};
