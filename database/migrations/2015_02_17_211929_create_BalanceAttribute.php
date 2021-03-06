<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceAttribute extends Migration {

    public function up() {
        Schema::table('users', function($table) {
            $table->double('balance')->nullable()->default(0);
        });
    }

    public function down() {
        Schema::table('users', function($table) {
            $table->dropColumn('balance');
        });
    }

}
