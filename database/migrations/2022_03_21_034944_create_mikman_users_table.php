<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMikmanUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mikman_users', function (Blueprint $table) {
            $table->id();
            $table->text('username');
            $table->text('password');
            $table->text('email');
            $table->text('phone');
            $table->text('created_at');
            $table->text('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mikman_users');
    }
}
