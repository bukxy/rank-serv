<?php

namespace App\Console\Commands;

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
    protected $signature = 'voteDelete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete votes after 2 hours';

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
        Vote::where('expiration', '<=', Carbon::now()->tz('Europe/Paris')->toDateTimeString())->each(function ($i) {
            $i->delete();
        });
    }
}
