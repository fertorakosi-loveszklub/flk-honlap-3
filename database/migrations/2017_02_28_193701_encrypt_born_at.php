<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EncryptBornAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_profiles', function (Blueprint $table) {
            $table->dropColumn('born_at');
        });

        Schema::table('member_profiles', function (Blueprint $table) {
            $table->text('born_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Do not reverse
    }
}
