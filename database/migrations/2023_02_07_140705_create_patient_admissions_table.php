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
        Schema::create('patient_admissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'patient_id' );
            $table->unsignedBigInteger( 'ward_id' );
            $table->unsignedBigInteger( 'bed_id' );
            $table->date( 'admission_date' );
            $table->date( 'discharge_date' )->nullable();

            $table->foreign( 'patient_id' )->references( 'id' )->on( 'patients' );
            $table->foreign( 'ward_id' )->references( 'id' )->on( 'wards' );
            $table->foreign( 'bed_id' )->references( 'id' )->on( 'beds' );
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
        Schema::dropIfExists('patient_admissions');
    }
};
