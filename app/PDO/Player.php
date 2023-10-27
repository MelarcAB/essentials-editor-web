<?php

namespace App\PDO;

class Player
{
    private $path = "/Graphics/Characters/";

    public $id;
    public $TrainerType;
    //defaultCharset es tambien el tipo de entrenador
    public $DefaultCharset;
    public $WalkCharset;
    public $RunCharset;
    public $CycleCharset;
    public $SurfCharset;
    public $DiveCharset;
    public $FishCharset;
    public $SurfFishCharset;
    public $Home;

    //todos los parametros son opcionales

    public function __construct(
        $id = "",
        $TrainerType = "",
        $DefaultCharset = "",
        $WalkCharset = null,
        $RunCharset = null,
        $CycleCharset = null,
        $SurfCharset = null,
        $DiveCharset = null,
        $FishCharset = null,
        $SurfFishCharset = null,
        $Home = null
    ) {
        $this->TrainerType = $TrainerType;
        $this->id = $id;
        $this->DefaultCharset = $DefaultCharset;
        $this->WalkCharset = $WalkCharset;
        $this->RunCharset = $RunCharset;
        $this->CycleCharset = $CycleCharset;
        $this->SurfCharset = $SurfCharset;
        $this->DiveCharset = $DiveCharset;
        $this->FishCharset = $FishCharset;
        $this->SurfFishCharset = $SurfFishCharset;
        $this->Home = $Home;
    }


    /**
     * Las variables de player se guardaran como atributos de esta clase, los atributos externos que no pertenezcan a player 
     * se obtendran a partir de getters
     */

     /**
      * Get Player Sprite (buscara en /Graphics/Characters)
      */
    public function getSprite()
    {
        $path = "/graphics/trainers/";
        //remove trainer_ from the name
        $sprite_name = substr($this->DefaultCharset, 8);
        $sprite = $path . $sprite_name . ".png";
        return $sprite;
        
    }


}