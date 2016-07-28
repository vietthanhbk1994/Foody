<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatefoodsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('foods', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->string('image', 100);
            $table->Integer('category_id')->unsigned();
            $table->Integer('author')->unsigned();
            $table->text('content');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('foods', function(Blueprint $table) {
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
        //Create foreign kry
        Schema::table('foods',function(Blueprint $table){
            $table->foreign('author')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('foods');
        Schema::table('foods', function(Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
        //Drop foreign key
        Schema::table('foods', function (Blueprint $table) {
            $table->dropForeign(['author']);
        });
    }

}
