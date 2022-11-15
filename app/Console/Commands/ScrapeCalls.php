<?php

namespace App\Console\Commands;

use App\Modules\CallModule\ExternalCall;
use Illuminate\Console\Command;

class ScrapeCalls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:calls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scraping of calls';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ExternalCall = new ExternalCall();
        $ExternalCall->searchInNodoka();
        $ExternalCall->searchInCamaraComercioBogota();
        $ExternalCall->searchInMinciencias();
        return;
    }
}
