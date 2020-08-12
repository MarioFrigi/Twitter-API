<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->date('birthday')->nullable();
            $table->double('lon')->nullable();
            $table->double('lat')->nullable();
            $table->boolean('verified')->nullable();
            $table->timestamps();
        });

        $user = new App\User();
        $user->password = Hash::make('admin');
        $user->email = 'prueba@gmail.com';
        $user->save();
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
