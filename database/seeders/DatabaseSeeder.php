<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Game;
use Core\BoundedContext\Game\Infrastructure\Persistence\Eloquent\GameModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Game::factory()->count(1)->create([
            'name' => 'Bamboo Rush',
            'url' => 'https://latamwin-gp3.discreetgaming.com/cwguestlogin.do?bankId=3006&gameId=806&lang=es',
            'pathImage' => 'https://winchiletragamonedas.com/public/images/games/bamboo_rush.jpeg'
        ]);
        Game::factory()->count(1)->create([
            'name' => 'Reels of Wealth',
            'url' => 'https://latamwin-gp3.discreetgaming.com/cwguestlogin.do?bankId=3006&gameId=795&lang=es',
            'pathImage' => 'https://winchiletragamonedas.com/public/images/games/reels_of_wealth.jpeg'
        ]);
        Game::factory()->count(1)->create([
            'name' => 'Dragon & Phoenix',
            'url' => 'https://latamwin-gp3.discreetgaming.com/cwguestlogin.do?bankId=3006&gameId=814&lang=es',
            'pathImage' => 'https://winchiletragamonedas.com/public/images/games/dragon_phoenix.jpeg'
        ]);
    }
}
