<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 15);

            $table->boolean('role_create')->default(false);
            $table->boolean('role_read')->default(false);
            $table->boolean('role_update')->default(false);
            $table->boolean('role_delete')->default(false);

            $table->boolean('user_create')->default(false);
            $table->boolean('user_read')->default(false);
            $table->boolean('user_update')->default(false);
            $table->boolean('user_delete')->default(false);

            $table->boolean('expense_category_create')->default(false);
            $table->boolean('expense_category_read')->default(false);
            $table->boolean('expense_category_update')->default(false);
            $table->boolean('expense_category_delete')->default(false);

            $table->boolean('expense_create')->default(false);
            $table->boolean('expense_read')->default(false);
            $table->boolean('expense_update')->default(false);
            $table->boolean('expense_delete')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}