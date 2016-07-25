<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAuthorFood extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Add column author
        Schema::table('foods', function (Blueprint $table) {
            $table->integer('author')->unsigned();
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
    public function down()
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->dropIndex(['author']); // Drops index 'geo_state_index'
        });
        //Drop table
        Schema::table('foods', function (Blueprint $table) {
            $table->dropForeign(['author']);
        });
        
    }
}
