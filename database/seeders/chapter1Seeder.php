<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Item;
use App\Models\Event;

class Chapter0Seeder extends Seeder
{
    public function run(): void
    {
        // ROOM 1 garden:
        $garden = Room::create([
            'name' => 'The Garden',
            'description' => 'A lush garden outside a mysterious mansion.',
            'image_url' => '/public/build/assets/rooms/garden_1.svg'
        ]);

        // ITEM IO tree
        $tree = Item::create([
            'name' => 'Cypress',
            'css_id' => 'tree',
            'image_url' => '/public/build/assets/items/tree.png',
            'description' => 'Creepy Cypress',
            'is_portable' => false, 'is_visible' => true,
            'room_id' => $garden->id
        ]);

        //ITEM PO ball
        $ball = Item::create([
            'name' => 'Tennis Ball',
            'css_id' => 'tennis_ball',
            'image_url' => '/public/build/assets/items/tennis_ball.png',
            'description' => 'You only live once, but you get to serve twice',
            'is_portable' => true, 
            'is_visible' => false, // Hidden until tree is pushed
            'room_id' => $garden->id
        ]);

        //----------->>>  add flower pot here

         //ITEM PO ball
        $key = Item::create([
            'name' => 'Mansion Key',
            'css_id' => 'Key',
            'image_url' => '/public/build/assets/items/key.png',
            'description' => 'shinny!',
            'is_portable' => true, 
            'is_visible' => true, // temp. it will be Hidden until flower pot is moved
            'room_id' => $garden->id
        ]);

        // EVENT -> find the ball
        Event::create([
            'verb_trigger' => 'PUSH',
            'item_id' => $tree->id,
            'unlocked_item_id' => $ball->id,
            'advances_story' => 0
              ]);

        // ITEM IO dog
        $dog = Item::create([
            'name' => 'Mean Dog',
            'css_id' => 'dog',
            'image_url' => '/public/build/assets/items/object_02.png',
            'description' => 'You shall not pass!',
            'is_portable' => false, 
            'is_visible' => true,
            'room_id' => $garden->id
        ]);

        // EVENT -> Distract Dog
        Event::create([
            // step_required is 0 by default
            'verb_trigger' => 'USE',
            'item_id' => $dog->id,           // The Dog is the target
            'required_item_id' => $ball->id, // The Ball is the tool from the pocket
            'target_room_id' => null,        // We aren't moving rooms yet, just clearing the path
            'next_step' => 1            // This completes Step 0!
        ]);


        // ---------------- CHAPTER 2 ---------------------------//

         // ITEM IO door
        $mansion_door = Item::create([
            'name' => 'Mansion Door',
            'css_id' => 'mansion_entrance',
            'description' => 'It is looked...',
            'is_portable' => false, 
            'is_visible' => true,
            'room_id' => $garden->id
        ]);

          // ROOM 2 present library
         $presentLibrary = Room::create([
            'name' => 'The Garden',
            'description' => 'a library in the present',
            'image_url' => 'room_2.svg'
        ]);

          // EVENT -> open door
        $door = Item::create([
            'step_required' => 1,  //NOW we have access to the door 
            'verb_trigger' => 'USE',
            'item_id' => $mansion_door->id,          
            'required_item_id' => $key->id, 
            'target_room_id' => null,        
            'next_step' => 2   // access to the present library         
        ]);

        

      

    }
}