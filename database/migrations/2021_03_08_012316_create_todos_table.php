<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->text('todo');
            // deadline  nullでも可能
            $table->dateTime('deadline')->nullable();
            // created_at updated_at
            $table->timestamps();
            // 符合なしにする user_id
            $table->integer('user_id')->unsigned();
            // 外部キーを設定する
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->string('user_email')->unique();
            // 外部キーを設定する
            $table->foreign('user_email')->references('email')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');

        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn('user_email');
        });


    }
}
