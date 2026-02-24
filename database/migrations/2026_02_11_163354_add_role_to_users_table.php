<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // 1. Agar role column pehle se ho → usko normal string me convert karo
            if (Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('user')->change();
            } else {
                $table->string('role')->default('user')->after('password');
            }

            // 2. user_id add karo
            if (!Schema::hasColumn('users', 'user_id')) {
                $table->string('user_id')->nullable()->after('user_name');
            }
        });

        // ===== SAFE UPDATE LOGIC =====

        DB::table('users')
            ->where('role', 'customer')
            ->update(['role' => 'user']);

        // DB::table('users')
        //     ->where('role', 'employee')
        //     ->update(['role' => 'admin']);
    }


    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $columns = [];

            if (Schema::hasColumn('users', 'role')) {
                $columns[] = 'role';
            }

            if (Schema::hasColumn('users', 'user_id')) {
                $columns[] = 'user_id';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
