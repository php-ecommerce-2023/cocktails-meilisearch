<?php

namespace App\Livewire;

use App\Models\Cocktail;
use Livewire\Component;
use Livewire\WithPagination;

class CocktailFinder extends Component
{
    use WithPagination;

    public $query = '';

    public $facetFilters = [
        'category' => [],
        'ingredients' => [],
    ];

    public $facets = [];

    public function search()
    {
        $this->resetPage();
    }

    public function render()
    {
        $filter = collect($this->facetFilters)
            ->map(
                function ($facet, $key) {
                    if(!empty($facet))
                    {
                        $filter = collect($facet)->map(function ($value) use ($key) {
                            return $key . ' = "' . $value . '"';
                        })->implode(' AND ');
                        return '(' . $filter . ')';
                    }else{
                        return false;
                    }
                }
            )  
            ->filter()
            ->implode(' AND ');
        
        $query = Cocktail::search($this->query, function (\Meilisearch\Endpoints\Indexes $meilisearch, $query, $options) use($filter) {
                $options['facets'] = ['ingredients', 'category'];
                $options['filter'] = $filter;
                return $meilisearch->search($query, $options);
        })->paginateRaw(5);

        $cocktails = collect($query->items()['hits'] ?? [])->map(function ($item){
            return Cocktail::make($item);
        });

        if(empty($this->facets)){
            $this->facets = $query->items()['facetDistribution'] ?? [];
        }else{
            foreach($this->facets as $category => $facet){
                foreach($facet as $key => $value){
                    $this->facets[$category][$key] = 0;
                }
            }
            foreach($query->items()['facetDistribution'] ?? [] as $key => $value){
                foreach($value as $facet => $count){
                    $this->facets[$key][$facet] = $count;
                }
            }
        }

        return view('livewire.cocktail-finder', [
            'cocktails' => $cocktails,
            'pagination' => $query,
        ]);
    }
}
