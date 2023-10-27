<?php
namespace App\Services;

use App\PDO\Player;
use Illuminate\Support\Facades\File;
use App\PDO\GlobalSettings;

class Metadata
{

    private $path;


    public function __construct()
    {
        $this->path = env('PROJECT_PATH')."/PBS/metadata.txt";
    }


    public function loadData()
    {

        $players = $this->loadPlayers21();
        $globalSettings = $this->getGlobalSettings21();

        $data = [
            'players' => $players,
            'globalData' => $globalSettings
        ];

        return $data;

    }

    private function loadPlayers21() {
        $players = [];
        $contents = File::get($this->path);
        
        // Split by #-------------------------------
        $blocks = explode("#-------------------------------", $contents);
    
        $globalAttributes = []; // This will store attributes like Home that are common to all players.
        
        foreach ($blocks as $block) {
            $block = trim($block);
    
            // Skip if block is empty
            if (empty($block)) {
                continue;
            }
    
            // Get Player ID (e.g., [1])
            if (!preg_match('/\[(\d+)\]/', $block, $matches)) {
                continue;  // Skip this block if no ID is found
            }
            $id = $matches[1];
    
            // Split by new lines to extract attributes
            $lines = explode("\n", $block);
    
            $attributes = [];
            foreach ($lines as $line) {
                // Skip comments and empty lines
                if (strpos($line, "#") === 0 || trim($line) == "") {
                    continue;
                }
    
                // Extract attribute key and value
                if (strpos($line, " = ") !== false) {
                    list($key, $value) = explode(" = ", $line);
                    $attributes[$key] = $value;
                }
            }
    
            // If this is the first block ([0]), it has global attributes.
            if ($id == "0") {
                $globalAttributes = $attributes;
                continue;
            }
    
            // Constructing the Player
            $player = new Player(
                $id,
                $attributes['TrainerType'] ?? '',
                $attributes['WalkCharset'] ?? '',
                $attributes['WalkCharset'] ?? '',
                $attributes['RunCharset'] ?? '',
                $attributes['CycleCharset'] ?? '',
                $attributes['SurfCharset'] ?? '',
                $attributes['DiveCharset'] ?? '',
                $attributes['FishCharset'] ?? '',
                $attributes['SurfFishCharset'] ?? '',
                $globalAttributes['Home'] ?? null  // Assign the global Home value
            );
    
            $players[] = $player;
        }
    
        return $players;
    }
    
    private function loadPlayers(){
        //Read the file
        $players= [];
        $lines = File::lines($this->path);
    
        //Obtener todas las líneas que EMPIEZAN por PlayerA,PlayerB,PlayerC,PlayerD,PlayerE,PlayerF,PlayerG
        foreach ($lines as $line) {
           

            if (strpos($line, "Player") !== false) {
                //Ejemplo de linea: PlayerA = POKEMONTRAINER_Red,trainer_POKEMONTRAINER_Red,boy_bike,boy_surf,boy_run,boy_surf,boy_fish_offset,boy_fish_offset
                $player = new Player();
                $player->id=(substr($line, 0, strpos($line, "=")));
                $attributes = (substr($line, strpos($line, "=")+1));

                $attributes = explode(",", $attributes);
                //trim de cada elemento del array
                $attributes = array_map('trim', $attributes);
    
                $player->TrainerType=$attributes[0];
                $player->DefaultCharset=$attributes[1];
                $player->WalkCharset=$attributes[2];
                $player->RunCharset=$attributes[3];
                $player->CycleCharset=$attributes[4];
                $player->SurfCharset=$attributes[5];
                $player->DiveCharset=$attributes[6];
                $player->FishCharset=$attributes[7];
               // $player->SurfFishCharset=$attributes[8];
               // $player->Home=$attributes[9];
                $players[] = $player;
            }
        }
        return $players;
    }

    public function getGlobalSettings21()
    {
        $settings = new GlobalSettings();
        $lines = File::lines($this->path);
        $isGlobalSection = false;

        foreach ($lines as $line) {
            $line = trim($line);
            //si la linea empieza por # o esta vacia, la saltamos
            if (empty($line) || strpos(trim($line), "#") === 0) {
                continue; // skip the current line
            }

            // Detect the start of the global section
            if ($line === "[0]") {
                $isGlobalSection = true;
                continue; // skip the current line
            }

            // Exit loop if we've passed the global section
            if ($isGlobalSection && strpos($line, "[") === 0) {
                break;
            }
            
            if ($isGlobalSection && strpos($line, "=") !== false) {
                list($key, $value) = explode("=", $line);
                $key = trim($key);
                $value = trim($value);

                switch ($key) {
                    case "StartMoney":
                        $settings->StartMoney = $value;
                        break;
                    case "StartItemStorage":
                        $settings->StartItemStorage = $value;
                        break;
                    case "Home":
                        $settings->Home = explode(",", $value);
                        break;
                    case "StorageCreator":
                        $settings->StorageCreator = $value;
                        break;
                    case "WildBattleBGM":
                        $settings->WildBattleBGM = $value;
                        break;
                    // ... (haz lo mismo para los demás campos)
                }
            }
        }

        return $settings;
    }
    public function getGlobalSettings()
    {
        $settings = new GlobalSettings();
        $lines = File::lines($this->path);
        $isGlobalSection = false;

        foreach ($lines as $line) {
            $line = trim($line);
            //si la linea empieza por # o esta vacia, la saltamos
            if (empty($line) || strpos(trim($line), "#") === 0) {
                continue; // skip the current line
            }

            // Detect the start of the global section
            if ($line === "[000]") {
                $isGlobalSection = true;
                continue; // skip the current line
            }

            // Exit loop if we've passed the global section
            if ($isGlobalSection && strpos($line, "[") === 0) {
                break;
            }
            
            if ($isGlobalSection && strpos($line, "=") !== false) {
                list($key, $value) = explode("=", $line);
                echo $key." - ".$value."<br>";
                $key = trim($key);
                $value = trim($value);

                switch ($key) {
                    case "StartMoney":
                        $settings->StartMoney = $value;
                        break;
                    case "StartItemStorage":
                        echo 'estic startitemstorage';
                        $settings->StartItemStorage = $value;
                        break;
                    case "Home":
                        echo 'estic home';
                        $settings->Home = explode(",", $value);
                        break;
                    case "StorageCreator":
                        $settings->StorageCreator = $value;
                        break;
                    case "WildBattleBGM":
                        $settings->WildBattleBGM = $value;
                        break;
                    // ... (haz lo mismo para los demás campos)
                }
            }
        }

        return $settings;
    }

}