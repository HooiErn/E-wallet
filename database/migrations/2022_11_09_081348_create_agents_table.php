<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('account_id')->default(1);
            $table->string('account_name');
            $table->string('account_level');
            $table->string('name');
            $table->string('username');
            $table->string('email',191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('ic')->max(12)->nullable();
            $table->string('handphone_number')->nullable();
            $table->string('base_currency')->nullable();
            $table->integer('credit_available')->unsigned();
            $table->string('address')->nullable();
            $table->string('remark')->nullable();
            $table->string('status')->nullable();
            $table->integer('credit_limit')->unsigned();
            $table->date('join_date');
            $table->string('created_by');
            $table->string('deleted_by')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('agents');
    }
}
