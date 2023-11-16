<?php

namespace App\PDO;

class Item
{
    public $Id;
    public $IdName;
    public $Name;
    public $NamePlural;
    public $Pocket;
    public $Price;
    public $Description;
    public $FieldUse;
    public $BattleUse;
    public $Type;
    public $Move;
    public $Flags;
    public $PortionName;
    public $PortionNamePlural;
    public $BPPrice;
    public $Consumable;
    public $ShowQuantity;

    public function __construct(
        $Id = "",
        $IdName = "",
        $Name = "",
        $NamePlural = "",
        $Pocket = "",
        $Price = "",
        $Description = "",
        $FieldUse = "",
        $BattleUse = "",
        $Type = "",
        $Move = "",
        $Flags = "",
        $PortionName = "",
        $PortionNamePlural = "",
        $BPPrice = "",
        $Consumable = "",
        $ShowQuantity = ""
    ) {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->IdName = $IdName;
        $this->NamePlural = $NamePlural;
        $this->Pocket = $Pocket;
        $this->Price = $Price;
        $this->Description = $Description;
        $this->FieldUse = $FieldUse;
        $this->BattleUse = $BattleUse;
        $this->Type = $Type;
        $this->Move = $Move;
        $this->Flags = $Flags;
        $this->PortionName = $PortionName;
        $this->PortionNamePlural = $PortionNamePlural;
        $this->BPPrice = $BPPrice;
        $this->Consumable = $Consumable;
        $this->ShowQuantity = $ShowQuantity;

    }


    public function getSprite()
    {
        return "/Graphics/Items/" . $this->IdName . ".png";
    }

    //get Pocket Names
    /*
    1 - Items
2 - Medicine
3 - Poké Balls
4 - TMs & HMs
5 - Berries
6 - Mail
7 - Battle Items
8 - Key Items
*/
    public static function getPocketName($pocket_id)
    {
        switch ($pocket_id) {
            case 1:
                return "Items";
                break;
            case 2:
                return "Medicine";
                break;
            case 3:
                return "Poké Balls";
                break;
            case 4:
                return "TMs & HMs";
                break;
            case 5:
                return "Berries";
                break;
            case 6:
                return "Mail";
                break;
            case 7:
                return "Battle Items";
                break;
            case 8:
                return "Key Items";
                break;
            default:
                return "Items";
                break;
        }
    }

    public static function getPockets(){
        return [
            1 => "Items",
            2 => "Medicine",
            3 => "Poké Balls",
            4 => "TMs & HMs",
            5 => "Berries",
            6 => "Mail",
            7 => "Battle Items",
            8 => "Key Items"
        ];
    }
}
