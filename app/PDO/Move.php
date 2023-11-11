<?php

namespace App\PDO;

use Illuminate\Support\Facades\File;

class Move
{
    public $IdName;
    public $Name;

    public $Description;
    public $Type;
    public $Category;
    public $Power;
    public $Accuracy;
    public $TotalPP;
    public $FunctionCode;
    public $Flags;
    public $EffectChance;
    public $Priority;
    public $Target;

    private $path;



    //constructor
    public function __construct(
        $IdName = "",
        $Name = "",
        $Description = "",
        $Type = "",
        $Category = "",
        $Power = "",
        $Accuracy = "",
        $TotalPP = "",
        $FunctionCode = "",
        $Flags = "",
        $EffectChance = "",
        $Priority = "",
        $Target = ""
    ) {
        $this->IdName = $IdName;
        $this->Name = $Name;
        $this->Description = $Description;
        $this->Type = $Type;
        $this->Category = $Category;
        $this->Power = $Power;
        $this->Accuracy = $Accuracy;
        $this->TotalPP = $TotalPP;
        $this->FunctionCode = $FunctionCode;
        $this->Flags = $Flags;
        $this->EffectChance = $EffectChance;
        $this->Priority = $Priority;
        $this->Target = $Target;

        $this->path = env('PROJECT_PATH', '') . "/PBS/Moves.txt";
    }


    public function getMoves()
    {
        $path = $this->path;
        $content = File::get($path);

        $movesData = array_filter(explode('#-------------------------------', $content));

        $moves = [];

        foreach ($movesData as $moveData) {
            $lines = array_filter(explode("\n", $moveData));
            $move = new Move();

            foreach ($lines as $line) {
                if (strpos($line, '[') === 0) {
                    $move->IdName = trim(str_replace(['[', ']'], '', $line));
                } elseif (strpos($line, 'Name = ') === 0) {
                    $move->Name = trim(str_replace('Name = ', '', $line));
                } elseif (strpos($line, 'Description = ') === 0) {
                    $move->Description = trim(str_replace('Description = ', '', $line));
                } elseif (strpos($line, 'Type = ') === 0) {
                    $move->Type = trim(str_replace('Type = ', '', $line));
                } elseif (strpos($line, 'Category = ') === 0) {
                    $move->Category = trim(str_replace('Category = ', '', $line));
                } elseif (strpos($line, 'Power = ') === 0) {
                    $move->Power = trim(str_replace('Power = ', '', $line));
                } elseif (strpos($line, 'Accuracy = ') === 0) {
                    $move->Accuracy = trim(str_replace('Accuracy = ', '', $line));
                } elseif (strpos($line, 'TotalPP = ') === 0) {
                    $move->TotalPP = trim(str_replace('TotalPP = ', '', $line));
                } elseif (strpos($line, 'FunctionCode = ') === 0) {
                    $move->FunctionCode = trim(str_replace('FunctionCode = ', '', $line));
                } elseif (strpos($line, 'Flags = ') === 0) {
                    $move->Flags = trim(str_replace('Flags = ', '', $line));
                } elseif (strpos($line, 'EffectChance = ') === 0) {
                    $move->EffectChance = trim(str_replace('EffectChance = ', '', $line));
                } elseif (strpos($line, 'Priority = ') === 0) {
                    $move->Priority = trim(str_replace('Priority = ', '', $line));
                } elseif (strpos($line, 'Target = ') === 0) {
                    $move->Target = trim(str_replace('Target = ', '', $line));
                }
            }

            $moves[] = $move;
        }

        return $moves;
    }


    //getMove
    public function getMove($idname)
    {
        $moves = $this->getMoves();

        foreach ($moves as $move) {
            if (strtolower($move->IdName) == strtolower($idname)) {
                return $move;
            }
        }

        return null;
    }


}
