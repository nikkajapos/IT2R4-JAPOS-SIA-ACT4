<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('tbluser', function (Blueprint $table) {
            if (!Schema::hasColumn('tbluser', 'username')) {
                $table->string('username')->after('id');
            }
            if (!Schema::hasColumn('tbluser', 'gender')) {
                $table->string('gender')->after('password');
            }
        });
    }

    public function down() {
        Schema::table('tbluser', function (Blueprint $table) {
            if (Schema::hasColumn('tbluser', 'username')) {
                $table->dropColumn('username');
            }
            if (Schema::hasColumn('tbluser', 'gender')) {
                $table->dropColumn('gender');
            }
        });
    }
};
