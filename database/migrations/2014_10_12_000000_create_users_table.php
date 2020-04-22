<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('messenger_id',100)->unique();
            $table->string('university_name',100)->nullable(true);
            $table->string('student_code',100)->nullable(true);
            $table->string('first_name',100)->nullable(true);
            $table->string('last_name',100)->nullable(true);
            $table->string('profile_pic')->nullable(true);
            $table->string('locale',50)->nullable(true);
            $table->string('gender',50)->nullable(true);
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
    }
}
