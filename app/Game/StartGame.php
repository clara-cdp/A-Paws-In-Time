<?php

namespace App\Game;

use Illuminate\Support\Facades\DB;

use App\Models\Player;
use App\Models\User;
use App\Models\Room;
use App\Models\Pocket;
use App\Models\PocketItem;
use App\Models\Item;

class StartGame
{
    public function handle(User $user, string $name): Player
    {
        return DB::transaction(function () use ($user, $name) {

            $player = Player::create([
                'user_id' => $user->id,
                'character_name' => $name,
                'room_id' => Room::where('name', 'The Garden')->firstOrFail()->id,
                'story_step' => 0,
            ]);

           
            $this->createPlayerWorld($player);

            $pocket = Pocket::create([
                'player_id' => $player->id,
            ]);

            $this->giveStarterItem($pocket);

            return $player;
        });
    }

    protected function giveStarterItem(Pocket $pocket): void
    {
        PocketItem::create([
            'pocket_id' => $pocket->id,
            'item_id'   => Item::starter()->id
        ]);
    }

    protected function createPlayerWorld(Player $player): void
    {
        $items = Item::withoutGlobalScopes()
            ->whereNull('player_id')
            ->get();

        foreach ($items as $item) {

            Item::create([
                'player_id'   => $player->id,
                'css_id'      => $item->css_id,
                'description' => $item->description,
                'image_url'   => $item->image_url,
                'is_portable' => $item->is_portable,
                'is_visible'  => $item->is_visible,
                'room_id'     => $item->room_id,
                'event_id'    => $item->event_id
            ]);
        }
    }
}
