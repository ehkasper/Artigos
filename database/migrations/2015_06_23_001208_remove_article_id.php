<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveArticleId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropForeign('tags_article_id_foreign');
            $table->dropColumn('article_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->integer('article_id')->unsigned();

        $table->foreign('article_id')->references('id')->on('articles')
              ->onDelete('cascade');
    }
}
