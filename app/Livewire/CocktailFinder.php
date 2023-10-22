<?php

namespace App\Livewire;

use App\Models\Cocktail;
use Livewire\Component;
use Livewire\WithPagination;

class CocktailFinder extends Component
{
    use WithPagination;

    public $query = '';

    public function search()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.cocktail-finder', [
            'cocktails' => Cocktail::search($this->query)->paginate(5),
        ]);
    }
}
