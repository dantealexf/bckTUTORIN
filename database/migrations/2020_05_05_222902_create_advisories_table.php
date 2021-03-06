<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvisoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advisories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('category_id')->nullable()->unsigned();
            $table->bigInteger('level_id')->nullable()->unsigned();

            $table->string('title');
            $table->string('url')->unique()->nullable();
            $table->date('delivery')->default(now()->addDay()->format('d-m-y'));
            $table->double('price')->default(0);
            $table->boolean('virtual');
            $table->integer('hours')->default(1);
            $table->mediumText('body')->nullable();
            $table->enum('status', ['PUBLISHED', 'DONE','PENDING'])->default('PUBLISHED');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('level_id')->references('id')->on('levels')
                ->onDelete('set null')
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
        Schema::dropIfExists('advisories');
    }
}
