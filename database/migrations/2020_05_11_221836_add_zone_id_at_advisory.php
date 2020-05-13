<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddZoneIdAtAdvisory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advisories', function (Blueprint $table) {

            $table->bigInteger('zone_id')->nullable()->unsigned()->after('level_id');

            $table->foreign('zone_id')->references('id')->on('zones')
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
        Schema::table('advisories', function (Blueprint $table) {
            //
        });
    }
}
