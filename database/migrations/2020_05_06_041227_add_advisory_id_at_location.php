<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdvisoryIdAtLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('locations', function (Blueprint $table) {

            $table->bigInteger('advisory_id')->nullable()->unsigned()->after('id');

            $table->foreign('advisory_id')->references('id')->on('advisories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
