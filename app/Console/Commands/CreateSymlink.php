<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateSymlink extends Command
{
    /**
     *  ATENCIÓN: Este comando DEBE EJECUTARSE DESDE LA CONSOLA DE ADMINISTRADOR (WINDOWS, BUSCAS POWER SHELL, CLICK DERECHO, EJECUTAR COMO ADMINISTRADOR)
     */
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'symlink:create';
    protected $description = 'Create a symlink for images';



    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->ensureDirectoryExists(public_path('graphics'));

        $paths = [
            'Characters' => public_path('graphics/characters'),
            'Characters/Followers' => public_path('graphics/characters/followers'),
            'Trainers' => public_path('graphics/trainers'),
            'Items' => public_path('graphics/items'),
            'Pokemon' => public_path('graphics/pokemon'),
            'Pictures' => public_path('graphics/pictures'),
            //raiz
        ];

        foreach ($paths as $key => $linkPath) {
            $imagesPath = env('PROJECT_PATH', '') . "/Graphics/{$key}";

            if (file_exists($imagesPath)) {
                $this->createSymlink($imagesPath, $linkPath, strtolower($key));
            } else {
                $this->error("Invalid path or path does not exist for {$key}: " . $imagesPath);
            }
        }
    }

    private function ensureDirectoryExists($directory)
    {
        if (!file_exists($directory)) {
            mkdir($directory);
        }
    }

    private function createSymlink($target, $link, $type)
    {
        if (!is_link($link)) {
            if (symlink($target, $link)) {
                $this->info("Symlink for {$type} has been created successfully");
            } else {
                $this->error("Failed to create symlink for {$type}");
            }
        } else {
            $this->info("Symlink for {$type} already exists");
        }
    }
}
