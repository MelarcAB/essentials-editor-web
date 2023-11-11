<?php

namespace App\PDO;
use Illuminate\Support\Facades\File;

class Ability
{
    public $Name;

    public $Description;

    public $path ;


    //constructor
    public function __construct(
        $Name = "",
        $Description = ""
    ) {
        $this->Name = $Name;
        $this->Description = $Description;
        $this->path = env('PROJECT_PATH', '') . "/PBS/Abilities.txt";
    }

    //function GetAbilities
    public  function getAbilities($count=false)
    {
        $abilities = [];
        $contents = File::get($this->path);
    
        // Usar una expresión regular para localizar todos los bloques de habilidades
        preg_match_all('/\[(.*?)\]\s*(.*?)(?=\[|$)/s', $contents, $matches, PREG_SET_ORDER);
    
        foreach ($matches as $match) {
            $idName = $match[1];
            $block = $match[2];
    
            // Dividir por líneas
            $lines = explode("\n", $block);
    
            $attributes = [];
            foreach ($lines as $line) {
                // Saltar comentarios y líneas vacías
                if (strpos($line, "#") === 0 || trim($line) == "") {
                    continue;
                }
    
                // Verificar si la línea contiene el patrón " = " y luego dividir
                if (strpos($line, " = ") !== false) {
                    list($key, $value) = explode(" = ", $line);
                    $attributes[$key] = $value;
                }
            }
    
            // Remover todos los posibles \n y \r al final de cada atributo
            foreach ($attributes as $key => $value) {
                $attributes[$key] = str_replace(["\n", "\r"], '', $value);
            }
    
            // Construir el objeto Ability
            $ability = new Ability(
                $attributes['Name'] ?? null,
                $attributes['Description'] ?? null
            );
    
            $abilities[] = $ability;
        }
    

        if($count){
            return count($abilities);
        }
        return $abilities;
    }


    public function getAbility($idName)
    {
        $abilities = $this->getAbilities();
        foreach ($abilities as $ability) {
           //verificar en lower case
            if (strtolower($ability->Name) == strtolower($idName)) {
                return $ability;
            }
        }
        return null;
    }


}
