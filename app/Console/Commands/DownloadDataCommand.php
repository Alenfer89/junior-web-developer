<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DownloadDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * Scarica i dati da questa api https://swapi.dev/api/people
         * ed aggiunti una lista di personaggi e film associati.
         * Model1: Character
         * Model2: Film
         *
         * Risultato Character::first()->films deve ritornare l'elenco di URL
         * a cui è associato il personaggio
         */

        return Command::SUCCESS;
    }
}
