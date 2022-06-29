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
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->boolean('category_index')->default(false);
            $table->boolean('category_store')->default(false);
            $table->boolean('category_show')->default(false);
            $table->boolean('category_update')->default(false);
            $table->boolean('category_destroy')->default(false);

            $table->boolean('menu_index')->default(false);
            $table->boolean('menu_store')->default(false);
            $table->boolean('menu_show')->default(false);
            $table->boolean('menu_update')->default(false);
            $table->boolean('menu_destroy')->default(false);

            $table->boolean('article_index')->default(false);
            $table->boolean('article_store')->default(false);
            $table->boolean('article_show')->default(false);
            $table->boolean('article_update_all')->default(false);
            $table->boolean('article_update_own')->default(false);
            $table->boolean('article_destroy_all')->default(false);
            $table->boolean('article_destroy_own')->default(false);

            $table->boolean('user_index')->default(false);
            $table->boolean('user_store')->default(false);
            $table->boolean('user_show_all')->default(false);
            $table->boolean('user_show_own')->default(false);
            $table->boolean('user_update_all')->default(false);
            $table->boolean('user_update_own')->default(false);
            $table->boolean('user_destroy_all')->default(false);
            $table->boolean('user_destroy_own')->default(false);

            $table->boolean('role_index')->default(false);
            $table->boolean('role_store')->default(false);
            $table->boolean('role_show')->default(false);
            $table->boolean('role_update')->default(false);
            $table->boolean('role_destroy')->default(false);

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
        Schema::dropIfExists('roles');
    }
};
