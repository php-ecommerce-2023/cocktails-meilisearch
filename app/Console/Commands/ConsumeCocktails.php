<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ConsumeCocktails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:consume-cocktails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $alphabet = range('a', 'z');

        foreach($alphabet as $character)
        {
            $this->info('Consuming cocktails starting with '.$character);
            $cocktails = \Illuminate\Support\Facades\Http::get('https://www.thecocktaildb.com/api/json/v1/1/search.php?f='.$character)->json()['drinks'];
            if(!$cocktails) {
                $this->comment('No cocktails found for '.$character);
                continue;
            }
            \Laravel\Prompts\progress(
                'Drinks '.$character, 
                $cocktails,
                function($cocktail) {
                    \App\Models\Cocktail::updateOrCreate(
                        ['id' => $cocktail['idDrink']],
                        \App\Models\Cocktail::transform($cocktail)
                    );
                }
            );
        }
    }
}
