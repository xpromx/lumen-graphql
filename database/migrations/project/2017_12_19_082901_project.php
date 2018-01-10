<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Project extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // contacts
        Schema::connection('project')->create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contact_type', 20)->default('user');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->dateTime('sent_at')->nullable();
            $table->integer('opened')->default(0);
            $table->dateTime('opened_at')->nullable();
            $table->integer('clicked')->default(0);
            $table->dateTime('clicked_at')->nullable();
            $table->integer('bounced')->default(0);
            $table->dateTime('bounced_at')->nullable();
            $table->json('meta')->nullable();
            $table->json('system')->nullable();
            $table->string('database_id')->nullable();
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
        Schema::connection('project')->dropIfExists('contacts');
        Schema::connection('project')->dropIfExists('events');
    }
}
