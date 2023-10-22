<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \Illuminate\Support\Facades\Http;

class ConsumeByRandom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:consume-by-random {--count=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches cocktails from thecocktaildb.com by Random';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Consuming '.$this->option('count').' cocktails');
        for($i = 0; $i < $this->option('count'); $i++)
            $this->consumeByRandom();
    }

    public function consumeByRandom()
    {
        $drinks = Http::get('www.thecocktaildb.com/api/json/v1/1/random.php')->json();
        $cocktail = collect(collect($drinks)->first())->first();
        if(!$cocktail) {
            $this->comment('No cocktails found');
            return;
        }
        $cocktail = \App\Models\Cocktail::updateOrCreate(
            ['id' => $cocktail['idDrink']],
            \App\Models\Cocktail::transform($cocktail)
        );
        $this->info('['.$cocktail->id.'] '.$cocktail->name.' created/updated');
    }
}
