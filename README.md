![Cocktails Demo](cocktails.png "COCKTAILS")

> Big thanks to https://www.thecocktaildb.com/api.php

Important files:

- `app/Console/Commands/ConsumeCocktails.php` 

Used to consume Cocktails for indexing

- `resources/views/livewire/cocktail-finder.blade.php`
- `app/Livewire/CocktailFinder.php`

Livewire Component for searching and visual part

- `database/migrations/2023_10_22_163345_create_cocktails_table.php`

Migration

- `config/scout.php:132`

Configuration for the Cocktails Model

- `app/Models/Cocktail.php`

Cocktails Model