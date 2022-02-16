<?php

namespace App\Console\Commands;

use App\Models\Server;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Console\Command;

class voteDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vote:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Vote::all()->each(function ($i) {
            $i->delete();
        });

        Server::all()->each(function ($i) {
            $i->vote = 0;
        });
    }
}
