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
        Schema::create('objects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->longText('description');
            $table->string('image_url', 45); 

            $table->boolean('is_portable')->default(false); // true = PO, false = IO
            $table->boolean('is_visible')->default(true);   // true = visible, false = hidden
        
            // This handles your 'collected' status
            $table->boolean('is_collected')->default(false); 

            // Foreign Keys
            $table->foreignId('room_id')->constrained();
            $table->foreignId('event_id')->nullable()->constrained();

            //css
            $table->string('css_id', 45)->unique();
            $table->integer('pos_x'); 
            $table->integer('pos_y'); 
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objects');
    }
};
