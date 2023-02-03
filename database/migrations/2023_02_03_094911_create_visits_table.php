<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'user_id' );
            $table->unsignedBigInteger( 'patient_id' );
            $table->text( 'symptoms' );
            $table->text( 'diagnosis' );
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
            $table->foreign( 'patient_id' )->references( 'id' )->on( 'patients' );
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
        Schema::dropIfExists('visits');
    }
};
