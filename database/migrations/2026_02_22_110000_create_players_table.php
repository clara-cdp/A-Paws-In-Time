<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('character_name',45);
        
            //link to rooms and pocket
            $table->foreignId('room_id')->constrained();
            $table->foreignId('pocket_id')->constrained();

            //link to user
            $table->integer('story_step')->default(0); // Added from your diagram
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //no user, no player
            $table->timestamps();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
