<?php
namespace App\Services;

use App\PDO\Item;
use Illuminate\Support\Facades\File;

class Items
{


    private $path;
    //constructor
    public function __construct()
    {
        $this->path = env('PROJECT_PATH') . "/PBS/items.txt";
    }
    public function loadData()
    {

        $items = $this->loadItems21();

        return $items;
    }
    private function loadItems21()
    {
        $items = [];
        $contents = File::get($this->path);

        // Split by #-------------------------------
        $blocks = explode("#-------------------------------", $contents);

        foreach ($blocks as $block) {
            $block = trim($block);

            // Skip if block is empty
            if (empty($block)) {
                continue;
            }

            // Get ID name (e.g., [MEGAHORN])
            if (!preg_match('/\[(.*?)\]/', $block, $matches)) {
                continue;  // Skip this block if no ID is found
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
            //quitar el espacio o salto de linea que pueda haber en los campos de la array (\r y \n)
            $attributes = array_map(function ($value) {
                return trim($value);
            }, $attributes);
            

            // Constructing the Item
            $item = new Item(
                '',  // Id is not provided in the new format
                $idName,
                $attributes['Name'] ?? '',
                $attributes['NamePlural'] ?? '',
                $attributes['Pocket'] ?? '',
                $attributes['Price'] ?? '',
                $attributes['Description'] ?? '',
                $attributes['FieldUse'] ?? '',
                '',  // BattleUse isn't provided in the new format
                $attributes['Type'] ?? '',
                $attributes['Move'] ?? '',
                $attributes['Flags'] ?? ''

            );

            $items[] = $item;
        }

        // Regroup items by pocket
        $pockets = [];
        foreach ($items as $item) {
            $pocket_name = Item::getPocketName($item->Pocket);
            $pockets[$pocket_name][] = $item;
        }

        return $pockets;
    }



    private function loadItems()
    {
        $items = [];
        $lines = File::lines($this->path);

        foreach ($lines as $line) {
            // Skip comments
            if (strpos($line, "#") === 0) {
                continue;
            }

            $attributes = explode(",", trim($line));

            if (count($attributes) >= 11) { // Ensure there are enough columns in the line
                $item = new Item(
                    $attributes[0],
                    // Id
                    $attributes[1],
                    // Name
                    $attributes[2],
                    // NamePlural
                    $attributes[3],
                    // Pocket
                    $attributes[4],
                    // Description
                    $attributes[5],
                    // Price
                    $attributes[6],
                    // FieldUse
                    $attributes[7],
                    // BattleUse
                    $attributes[8],
                    // Type
                    $attributes[9] // Move
                );

                $items[] = $item;
            }
        }
        /**
         * reagrupar los items por pocket
         */
        $pockets = [];
        foreach ($items as $item) {
            //obtener el nombre del pcket (clase getPocketName static de item)
            $pocket_name = Item::getPocketName($item->Pocket);
            $pockets[$pocket_name][] = $item;
        }
        $items = $pockets;
        //printar los keys

        return $items;
    }


    public function searchItem($IdName)
    {
        $items = $this->loadData();
        $item = null;
        foreach ($items as $pockets) {

            foreach ($pockets as $item) {
                if ($item->IdName == $IdName) {
                    return $item;
                }
            }
        }
        return $item;
    }


}