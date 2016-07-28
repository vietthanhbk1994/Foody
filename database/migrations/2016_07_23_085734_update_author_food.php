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
            $table->integer('author')->unsigned()->after('category_id')->default(1);
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
        //Drop author
        Schema::table('foods', function (Blueprint $table) {
            $table->dropColumn(['author']); // Drops index 'geo_state_index'
        });
        //Drop foreign key
        Schema::table('foods', function (Blueprint $table) {
            $table->dropForeign(['author']);
        });
        
    }
}
