<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//importar PDO Abilities
use App\PDO\Ability;
use App\PDO\Move;

class tests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ability = new Move();
        $abilities = $ability->getMove('SKYUPPERCUaT');
        dd($abilities);
    }
}
