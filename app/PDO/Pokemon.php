<?php

namespace App\PDO;
use Illuminate\Support\Facades\File;

class Pokemon
{
    public $Name;
    public $Types;
    public $BaseStats;
    public $GenderRatio;
    public $GrowthRate;
    public $BaseExp;
    public $EVs;
    public $CatchRate;
    public $Happiness;
    public $Abilities;
    public $HiddenAbilities;
    public $Moves;
    public $TutorMoves;
    public $EggMoves;
    public $EggGroups;
    public $HatchSteps;
    public $Height;
    public $Weight;
    public $Color;
    public $Shape;
    public $Habitat;
    public $Category;
    public $Pokedex;
    public $Generation;
    public $Evolutions;

    private $path;

    public function __construct(
        $Name = null,
        $Types = null,
        $BaseStats = null,
        $GenderRatio = null,
        $GrowthRate = null,
        $BaseExp = null,
        $EVs = null,
        $CatchRate = null,
        $Happiness = null,
        $Abilities = null,
        $HiddenAbilities = null,
        $Moves = null,
        $TutorMoves = null,
        $EggMoves = null,
        $EggGroups = null,
        $HatchSteps = null,
        $Height = null,
        $Weight = null,
        $Color = null,
        $Shape = null,
        $Habitat = null,
        $Category = null,
        $Pokedex = null,
        $Generation = null,
        $Evolutions = null
    ) {
        $this->Name = $Name;
        $this->Types = $Types;
        $this->BaseStats = $BaseStats;
        $this->GenderRatio = $GenderRatio;
        $this->GrowthRate = $GrowthRate;
        $this->BaseExp = $BaseExp;
        $this->EVs = $EVs;
        $this->CatchRate = $CatchRate;
        $this->Happiness = $Happiness;
        $this->Abilities = $Abilities;
        $this->HiddenAbilities = $HiddenAbilities;
        $this->Moves = $Moves;
        $this->TutorMoves = $TutorMoves;
        $this->EggMoves = $EggMoves;
        $this->EggGroups = $EggGroups;
        $this->HatchSteps = $HatchSteps;
        $this->Height = $Height;
        $this->Weight = $Weight;
        $this->Color = $Color;
        $this->Shape = $Shape;
        $this->Habitat = $Habitat;
        $this->Category = $Category;
        $this->Pokedex = $Pokedex;
        $this->Generation = $Generation;
        $this->Evolutions = $Evolutions;
        $this->path = env('PROJECT_PATH') . "/PBS/pokemon.txt";

    }

    public function getData()
    {
        $pokemon_list = $this->getPokemonList();
        return $pokemon_list;
    }

    private function getPokemonList()
    {
        $pokemons = [];
        $contents = File::get($this->path);

        // Split by #-------------------------------
        $blocks = explode("#-------------------------------", $contents);

        foreach ($blocks as $block) {
            $block = trim($block);

            // Skip if block is empty
            if (empty($block)) {
                continue;
            }

            // Get ID name (e.g., [BULBASAUR])
            if (!preg_match('/\[(.*?)\]/', $block, $matches)) {
                continue; // Skip this block if no ID is found
            }
            $idName = $matches[1];

            // Split by new lines
            $lines = explode("\n", $block);

            $attributes = [];
            foreach ($lines as $line) {
                // Skip comments and empty lines
                if (strpos($line, "#") === 0 || trim($line) == "") {
                    continue;
                }

                // Check if the line contains " = " pattern and then split
                if (strpos($line, " = ") !== false) {
                    list($key, $value) = explode(" = ", $line);
                    $attributes[$key] = $value;
                }
            }
            //remover todos los posibles \n y \r al final de cada atributo
            foreach ($attributes as $key => $value) {
                $attributes[$key] = str_replace(["\n", "\r"], '', $value);
            }

            // Constructing the Pokemon
            $pokemon = new Pokemon(
                $attributes['Name'] ?? null,
                $attributes['Types'] ?? null,
                $attributes['BaseStats'] ?? null,
                $attributes['GenderRatio'] ?? null,
                $attributes['GrowthRate'] ?? null,
                $attributes['BaseExp'] ?? null,
                $attributes['EVs'] ?? null,
                $attributes['CatchRate'] ?? null,
                $attributes['Happiness'] ?? null,
                $attributes['Abilities'] ?? null,
                $attributes['HiddenAbilities'] ?? null,
                $attributes['Moves'] ?? null,
                $attributes['TutorMoves'] ?? null,
                $attributes['EggMoves'] ?? null,
                $attributes['EggGroups'] ?? null,
                $attributes['HatchSteps'] ?? null,
                $attributes['Height'] ?? null,
                $attributes['Weight'] ?? null,
                $attributes['Color'] ?? null,
                $attributes['Shape'] ?? null,
                $attributes['Habitat'] ?? null,
                $attributes['Category'] ?? null,
                $attributes['Pokedex'] ?? null,
                $attributes['Generation'] ?? null,
                $attributes['Evolutions'] ?? null
            );

            $pokemons[] = $pokemon;
        }

        return $pokemons;
    }


    
    public function addPokemon($path) {
        $fileContent = "\n#-------------------------------\n";
        $fileContent .= "[$this->Name]\n";
        $fileContent .= "Name = $this->Name\n";
        $fileContent .= "Types = $this->Types\n";
        $fileContent .= "BaseStats = $this->BaseStats\n";
        $fileContent .= "GenderRatio = $this->GenderRatio\n";
        $fileContent .= "GrowthRate = $this->GrowthRate\n";
        $fileContent .= "BaseExp = $this->BaseExp\n";
        $fileContent .= "EVs = $this->EVs\n";
        $fileContent .= "CatchRate = $this->CatchRate\n";
        $fileContent .= "Happiness = $this->Happiness\n";
        $fileContent .= "Abilities = $this->Abilities\n";
        $fileContent .= "HiddenAbilities = $this->HiddenAbilities\n";
        $fileContent .= "Moves = $this->Moves\n";
        $fileContent .= "TutorMoves = $this->TutorMoves\n";
        $fileContent .= "EggMoves = $this->EggMoves\n";
        $fileContent .= "EggGroups = $this->EggGroups\n";
        $fileContent .= "HatchSteps = $this->HatchSteps\n";
        $fileContent .= "Height = $this->Height\n";
        $fileContent .= "Weight = $this->Weight\n";
        $fileContent .= "Color = $this->Color\n";
        $fileContent .= "Shape = $this->Shape\n";
        $fileContent .= "Habitat = $this->Habitat\n";
        $fileContent .= "Category = $this->Category\n";
        $fileContent .= "Pokedex = $this->Pokedex\n";
        $fileContent .= "Generation = $this->Generation\n";
        $fileContent .= "Evolutions = $this->Evolutions\n";
        $fileContent .= "#-------------------------------\n";
        
        // Append to the file
        File::append($path, $fileContent);
    }

    public function getPokemonName($parsed = false){
        if (!$parsed) return $this ->Name;
        $name = $this ->Name;
        
        //remove ' ','-',"."
        $name =str_replace([' ','-',".","♀","♂"],"" , $name);
        //replace ♂ with mA and ♀ with fA
        $name = str_replace ("♂","mA", $name);
        $name = str_replace ("♀","fE", $name);
        return $name;
    }

    public function getSprites(){
       return [
            "back" => "/Graphics/Pokemon/Back/" . $this->getPokemonName(true) . ".png",
            "front" => "/Graphics/Pokemon/Front/" . $this->getPokemonName(true) . ".png",
            "footprint" => "/Graphics/Pokemon/Footprints/" . $this->getPokemonName(true) . ".png",
            "icons" => "/Graphics/Pokemon/Icons/" . $this->getPokemonName(true) . ".png",
            "back_shiny" => "/Graphics/Pokemon/Back shiny/" . $this->getPokemonName(true) . ".png",
            "front_shiny" => "/Graphics/Pokemon/Front shiny/" . $this->getPokemonName(true) . ".png",
            "follower" => "/Graphics/Characters/Followers/". $this->getPokemonName(true) .  ".png",
        ];
    }

    public function searchPokemon($name) {
        $pokemons = $this->getPokemonList();
        foreach ($pokemons as $pokemon) {
           if (trim(strtoupper($pokemon->getPokemonName(true))) == $name) {
            return $pokemon;
           }
        }
        return false;
    }
    
}
