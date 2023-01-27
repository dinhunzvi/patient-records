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
    public function up(): void
    {
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'prescription_id' );
            $table->unsignedBigInteger( 'medicine_id' );
            $table->integer( 'quantity' );
            $table->text( 'dosage' );

            $table->foreign( 'prescription_id' )->on( 'prescriptions' )->references( 'id' );
            $table->foreign( 'medicine_id' )->on( 'medicines' )->references( 'id' );
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
        Schema::dropIfExists('prescription_items');
    }
};
