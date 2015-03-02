<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTable extends Migration {

    public function up() {
        Schema::create('budget', function(Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('expensesCategory_id')->unsigned();
            $table->foreign('expensesCategory_id')->references('id')->on('expensesCategories');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('savings');
    }

}
