<div class="cocktail-finder">
    <h1>Cocktail Finder</h1>
    <input type="search" wire:model="query" wire:keydown.enter="search">
    <div class="facets">
        @foreach ($facets as $facet => $values)
            <div class="facet">
                <h2>{{ ucfirst($facet) }}</h2>
                @foreach ($values as $key => $value)
                    <label class="{{ $value > 0 ? '' : 'hidden'}}">
                        {{ $key }}
                        <input type="checkbox" wire:model.live="facetFilters.{{$facet}}" value="{{ $key }}" >
                        {{ $value }}
                    </label>
                @endforeach
            </div>
        @endforeach
    </div>
    <div class="cocktails">
        @foreach ($cocktails as $cocktail)
        <div class="cocktail">
            <img src="{{ $cocktail->image }}" alt="{{ $cocktail->name }}">
            <aside>
                <h2>{{ $cocktail->name }}</h2>
                <p>{{ $cocktail->instructions }}</p>
                <ul>
                    @foreach ($cocktail->ingredients as $ingredient)
                        <li>{{ $ingredient }}</li>
                    @endforeach
                </ul>
                @foreach ($cocktail->mixing as $ingredient => $quantity)
                    <p>{{ $ingredient }}: {{ $quantity }}</p>
                @endforeach
            </aside>
        </div>
        @endforeach
        {{ $pagination->links() }}
    </div>
<style>
    .hidden{
        display: none;
        visibility: hidden;
    }
    .cocktail-finder{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .cocktails{
        display:flex;
        flex-direction: column;
        gap: 1rem;
        max-width: 800px;
        height: 80vh;
        overflow:auto;
    }
    .cocktail{
        display: flex;
        gap: 2rem;
        align-items: center;
        height: 280px;
        overflow: auto;
        min-height: 280px;
    }
    .cocktail img{
        width: auto;
        height: 250px;
    }
    .cocktail aside{
        width: 500px;
    }
    .facets{
        position: absolute;
        left: 5rem;
        top: 6rem;
        max-height: 80vh;
        overflow: auto;
    }
    .facet {
        display: flex;
        flex-direction: column;
    }
    .w-5{
        width: 0.5rem;
    } 
    .h-5{
        height: 0.5rem;
    }
</style>
</div>
