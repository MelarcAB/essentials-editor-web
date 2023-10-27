<?php

namespace App\PDO;

class GlobalSettings
{
    public $StartMoney;
    public $StartItemStorage;
    public $Home;
    public $StorageCreator;
    public $WildBattleBGM;
    public $TrainerBattleBGM;
    public $WildVictoryBGM;
    public $TrainerVictoryBGM;
    public $SurfBGM;
    public $BicycleBGM;

    public function __construct(
        $StartMoney = null,
        $StartItemStorage = null,
        $Home = null,
        $StorageCreator = null,
        $WildBattleBGM = null,
        $TrainerBattleBGM = null,
        $WildVictoryBGM = null,
        $TrainerVictoryBGM = null,
        $SurfBGM = null,
        $BicycleBGM = null
    ) {
        $this->StartMoney = $StartMoney;
        $this->StartItemStorage = $StartItemStorage;
        $this->Home = $Home;
        $this->StorageCreator = $StorageCreator;
        $this->WildBattleBGM = $WildBattleBGM;
        $this->TrainerBattleBGM = $TrainerBattleBGM;
        $this->WildVictoryBGM = $WildVictoryBGM;
        $this->TrainerVictoryBGM = $TrainerVictoryBGM;
        $this->SurfBGM = $SurfBGM;
        $this->BicycleBGM = $BicycleBGM;
    }
}
