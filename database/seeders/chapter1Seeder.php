<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Item;
use App\Models\Event;
use App\Enums\RoomType;

class Chapter1Seeder extends Seeder
{
    public function run(): void
    {

        //defeault ITEM
        $herring = Item::create([
            'css_id' => 'fish',
            'image_url' => 'build/assets/items/redHerring.png',
            'description' => 'A red herring',
            'is_portable' => false,
            'is_visible' => true,
            'room_id' => null
        ]);

        // ROOM 1 garden:
        $garden = Room::create([
            'name' => 'The Garden',
            'description' => 'A lush garden outside a mysterious mansion.',
            'image_url' => 'build/assets/rooms/garden_1.svg',
            'room_type' => RoomType::ALL
        ]);

        // ITEM IO tree
        $tree = Item::create([
            'css_id' => 'tree',
            'image_url' => null,
            'description' => 'Creepy Cypress',
            'is_portable' => false,
            'is_visible' => true,
            'room_id' => $garden->id
        ]);

        //ITEM PO ball
        $ball = Item::create([
            'css_id' => 'tennis_ball',
            'image_url' => 'build/assets/items/tennisBall.png',
            'description' => 'You only live once, but you get to serve twice',
            'is_portable' => true,
            'is_visible' => false, // Hidden until tree is pushed
            'room_id' => $garden->id
        ]);

        // EVENT -> find the ball
        Event::create([
            'verb_trigger' => 'PUSH',
            'item_id' => $tree->id,
            'unlocked_item_id' => $ball->id,
            'next_step' => 0
        ]);

        // ---------- tool box & crowbar

        // ITEM IO toolbox
        $toolbox = Item::create([
            'css_id' => 'toolbox',
            'image_url' => null,
            'description' => 'I have always wanted a toolbox',
            'is_portable' => false,
            'is_visible' => true,
            'room_id' => $garden->id
        ]);

        //ITEM PO Crowbar
        $crowbar = Item::create([
            'css_id' => 'Crowbar',
            'image_url' => 'build/assets/items/toolbox.png',
            'description' => 'So American!',
            'is_portable' => true,
            'is_visible' => false,
            'room_id' => $garden->id
        ]);


        // EVENT -> find the crowbar
        Event::create([
            'verb_trigger' => 'OPEN',
            'item_id' => $toolbox->id,
            'unlocked_item_id' => $crowbar->id,
            'next_step' => 0
        ]);


        //statue and key --------------------------

        //ITEM IO tentacle statue
        $statue = Item::create([
            'css_id' => 'statue',
            'image_url' => null,
            'description' => 'not this again...!',
            'is_portable' => false,
            'is_visible' => true,
            'room_id' => $garden->id
        ]);

        //ITEM PO Silver Key
        $key = Item::create([
            'css_id' => 'Key',
            'image_url' => '/public/build/assets/items/key.png',
            'description' => 'shinny!',
            'is_portable' => true,
            'is_visible' => false, // Hidden until statue is pushed
            'room_id' => $garden->id
        ]);

        // EVENT -> find the Mansion's key
        Event::create([
            'verb_trigger' => 'PUSH',
            'item_id' => $statue->id,
            'unlocked_item_id' => $key->id,
            'next_step' => 0
        ]);

        // ---------------- unlocking  CHAPTER 1 ---------------------------//
        //--------- DOG AND DOOR

        // ITEM IO dog
        $dog = Item::create([
            'css_id' => 'dog',
            'image_url' => null,
            'description' => 'You shall not pass!',
            'is_portable' => false,
            'is_visible' => true,
            'room_id' => $garden->id
        ]);

        // ITEM IO door
        $mansion_door = Item::create([
            'css_id' => 'mansion_entrance',
            'image_url' => null,
            'description' => 'It is looked...',
            'is_portable' => false,
            'is_visible' => false,
            'room_id' => $garden->id
        ]);


        // EVENT -> Distract Dog
        Event::create([
            'verb_trigger'     => 'USE',           // using the USE verb
            'item_id'          => $dog->id,        // click on the dog in the room
            'required_item_id' => $ball->id,       // with tennis ball selected from pocket
            'unlocked_item_id' => $mansion_door->id, // this door will become visible
            'target_room_id'   => null,           // stay in same room
            'next_step'        => 1,
        ]);


        // ---------------- unlocking  CHAPTER 2 ---------------------------//
        //------- opening mansion's door with a key



        // ROOM 2 present library
        $presentLibrary = Room::create([
            'name' => 'present_library',
            'description' => 'a library in the present',
            'image_url' => 'build/assets/rooms/present_library.svg',
            'room_type' => RoomType::HORIZONTAL
        ]);

        // EVENT -> open door
        Event::create([
            'step_required' => 1,  //NOW we have access to the door 
            'verb_trigger' => 'USE',
            'item_id' => $mansion_door->id,
            'required_item_id' => $key->id,
            'target_room_id' => null,
            'next_step' => 2   // access to the present library         
        ]);


        /*----------------------
        ELEMENTS USED IN NEXT CHAPTERS!
        ---------------------------*/

        // PO cuckoo bird ------------- event chapter 2!
        $cuckoo = Item::create([
            'css_id' => 'cuckoo',
            'image_url' => '/public/build/assets/items/cuckoo',
            'description' => "chip and chirp!",
            'is_portable' => true,
            'is_visible' => true,
            'room_id' => $garden->id
        ]);

        // ITEM IO grease pot ------------- event chapter 3!
        $greasePot = Item::create([
            'css_id' => 'grease_pot',
            'image_url' => null,
            'description' => "I can't carry that!",
            'is_portable' => false,
            'is_visible' => true,
            'room_id' => $garden->id
        ]);


        // ITEM IO ------------- event chapter 5?!
        $seed = Item::create([
            'css_id' => 'seed',
            'image_url' => null,
            'description' => "I wander what it makes",
            'is_portable' => false,
            'is_visible' => true,
            'room_id' => $garden->id
        ]);

        /*  * * * * *  CHAPTER 2 * * * * * * * * */
    }
}
