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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('step_number')->default(0); // To track story progress
            $table->string('verb_trigger', 45); 
        
            // -- trigger -- (not tiggers!)      
            $table->foreignId('item_id')->constrained(); //the IO in the room
            $table->foreignId('required_item_id')->nullable()->constrained('items'); // the PO in a pocket

            // --unlocks: ---
            // -> if IO is used -> sets visibility to true
            // -> if PO is used -> sets visibility to true & sets room to null (pocket)
            $table->foreignId('unlocked_item_id')->nullable()->constrained('items'); 

            // -> if PO is used -> unlocks next room 
            $table->foreignId('target_room_id')->nullable()->constrained('rooms');
            $table->integer('advances_story')->default(0);

          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
