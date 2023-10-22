<div class="cocktail-finder">
    <h1>Cocktail Finder</h1>
    <input type="search" wire:model="query" wire:keydown.enter="search">
    <div class="cocktails">
        @foreach ($cocktails as $cocktail)
        <div class="cocktail">
            <img src="{{ $cocktail->image }}" alt="{{ $cocktail->name }}">
            <aside>
                <h2>{{ $cocktail->name }}</h2>
                <p>{{ $cocktail->instructions }}</p>
                @foreach ($cocktail->ingredients as $ingredient => $quantity)
                    <p>{{ $ingredient }}: {{ $quantity }}</p>
                @endforeach
            </aside>
        </div>
        @endforeach
        {{ $cocktails->links() }}
    </div>
<style>
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

    .w-5{
        width: 0.5rem;
    } 
    .h-5{
        height: 0.5rem;
    }
</style>
</div>
