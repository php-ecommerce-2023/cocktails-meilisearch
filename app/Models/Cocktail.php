<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Cocktail extends Model
{
    use HasFactory, Searchable;

    public $guarded = [];

    public $casts = [
        'ingredients' => 'array',
        'date_modified' => 'datetime:Y-m-d H:i:s'
    ];

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string
    {
        return 'cocktails';
    }

        /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        $array = $this->toArray();
 
        $array['tags'] = explode(',', $array['tags']);
 
        return $array;
    }

    /*
        "idDrink" => "17222"
        "strDrink" => "A1"
        "strDrinkAlternate" => null
        "strTags" => null
        "strVideo" => null
        "strCategory" => "Cocktail"
        "strIBA" => null
        "strAlcoholic" => "Alcoholic"
        "strGlass" => "Cocktail glass"
        "strInstructions" => "Pour all ingredients into a cocktail shaker, mix and serve over ice into a chilled glass."
        "strInstructionsES" => "Vierta todos los ingredientes en una coctelera, mezcle y sirva con hielo en un vaso frío."
        "strInstructionsDE" => "Alle Zutaten in einen Cocktailshaker geben, mischen und über Eis in ein gekühltes Glas servieren."
        "strInstructionsFR" => null
        "strInstructionsIT" => "Versare tutti gli ingredienti in uno shaker, mescolare e servire con ghiaccio in un bicchiere freddo."
        "strInstructionsZH-HANS" => null
        "strInstructionsZH-HANT" => null
        "strDrinkThumb" => "https://www.thecocktaildb.com/images/media/drink/2x8thr1504816928.jpg"
        "strIngredient1" => "Gin"
        "strIngredient2" => "Grand Marnier"
        "strIngredient3" => "Lemon Juice"
        "strIngredient4" => "Grenadine"
        "strIngredient5" => null
        "strIngredient6" => null
        "strIngredient7" => null
        "strIngredient8" => null
        "strIngredient9" => null
        "strIngredient10" => null
        "strIngredient11" => null
        "strIngredient12" => null
        "strIngredient13" => null
        "strIngredient14" => null
        "strIngredient15" => null
        "strMeasure1" => "1 3/4 shot "
        "strMeasure2" => "1 Shot "
        "strMeasure3" => "1/4 Shot"
        "strMeasure4" => "1/8 Shot"
        "strMeasure5" => null
        "strMeasure6" => null
        "strMeasure7" => null
        "strMeasure8" => null
        "strMeasure9" => null
        "strMeasure10" => null
        "strMeasure11" => null
        "strMeasure12" => null
        "strMeasure13" => null
        "strMeasure14" => null
        "strMeasure15" => null
        "strImageSource" => null
        "strImageAttribution" => null
        "strCreativeCommonsConfirmed" => "No"
        "dateModified" => "2017-09-07 21:42:09"
    */
    /**
     * Transforms data from the API into a format that can be stored in the database.
     * @param array $data
     * @return array
     */
    public static function transform(array $data)
    {
        $ingredients = [
            $data['strIngredient1'] => trim($data['strMeasure1'] ?? ''),
            $data['strIngredient2'] => trim($data['strMeasure2'] ?? ''),
            $data['strIngredient3'] => trim($data['strMeasure3'] ?? ''),
            $data['strIngredient4'] => trim($data['strMeasure4'] ?? ''),
            $data['strIngredient5'] => trim($data['strMeasure5'] ?? ''),
            $data['strIngredient6'] => trim($data['strMeasure6'] ?? ''),
            $data['strIngredient7'] => trim($data['strMeasure7'] ?? ''),
            $data['strIngredient8'] => trim($data['strMeasure8'] ?? ''),
            $data['strIngredient9'] => trim($data['strMeasure9'] ?? ''),
            $data['strIngredient10'] => trim($data['strMeasure10'] ?? ''),
            $data['strIngredient11'] => trim($data['strMeasure11'] ?? ''),
            $data['strIngredient12'] => trim($data['strMeasure12'] ?? ''),
            $data['strIngredient13'] => trim($data['strMeasure13'] ?? ''),
            $data['strIngredient14'] => trim($data['strMeasure14'] ?? ''),
            $data['strIngredient15'] => trim($data['strMeasure15'] ?? ''),
        ];
        $ingredients = array_filter($ingredients);
        return [
            'id' => $data['idDrink'],
            'name' => $data['strDrink'],
            'alias' => $data['strDrinkAlternate'],
            'tags' => $data['strTags'],
            'category' => $data['strCategory'],
            'instructions' => $data['strInstructions'],
            'ingredients' => $ingredients,
            'image' => $data['strDrinkThumb'],
            'date_modified' => $data['dateModified'],
        ];
    }
}
