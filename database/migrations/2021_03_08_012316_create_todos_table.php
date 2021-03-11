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
            // $table->id();
            // $table->timestamps();
            // ここ編集


            $table->bigIncrements('id');
            $table->text('todo');
            // nullでも可能
            $table->date('deadline')->nullable();
            $table->timestamps();
            // 符合なしにする
            $table->integer('user_id')->unsigned();


            // 外部キーを設定する
            $table->foreign('user_id')->references('id')->on('users');

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
    }
}
