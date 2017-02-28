<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('member_profiles');

        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name');
            $table->integer('card_id')->unsigned();
            $table->timestamp('joined_at');
            $table->integer('ammo');

            // Encrypted personal data
            $table->text('address');
            $table->text('mother_name');
            $table->text('birth_place');
            $table->text('born_at');
            $table->text('email');
            $table->text('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
