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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->longText('description');
            $table->string('image_url', 45)->nullable();
            
            $table->boolean('is_portable')->default(false); // true = PO, false = IO
            $table->boolean('is_visible')->default(true);   // true = visible, false = hidden

            // Foreign Keys
            $table->foreignId('room_id')->constrained();
            $table->foreignId('event_id')->nullable()->constrained();

            //css
            $table->string('css_id', 45)->unique();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
