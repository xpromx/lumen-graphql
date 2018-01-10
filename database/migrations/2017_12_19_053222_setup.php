<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Setup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        // Users
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->string('role', 20)->default('user');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('token')->nullable();
            $table->json('meta')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Projects
        Schema::create('projects', function(Blueprint $table){

            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->string('name');
            $table->string('slug');            
            $table->json('meta')->nullable();
            $table->string('token')->nullable();
            $table->timestamps();

        });

        // Users Projects
        Schema::create('users_projects', function(Blueprint $table){

            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('project_id')->default(0);
            $table->string('token')->nullable();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('users_projects');
        Schema::dropIfExists('projects');
    }

  
}
