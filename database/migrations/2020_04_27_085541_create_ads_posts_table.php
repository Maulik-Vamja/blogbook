<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pay_id');
            $table->unsignedBigInteger('offer_id');
            $table->unsignedBigInteger('author_id');
            $table->string('image');
            $table->string('link');
            $table->timestamp('expire_time');
            $table->string('trans_id');
            $table->boolean('trans_status');
            $table->integer('total_price');
            $table->foreign('offer_id')
                ->references('id')->on('ads_offers')
                ->onDelete('cascade');
            $table->foreign('author_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('ads_posts');
    }
}
