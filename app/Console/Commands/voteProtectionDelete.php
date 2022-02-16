<?php

namespace App\Console\Commands;

use App\Models\VoteProtect;
use Carbon\Carbon;
use Illuminate\Console\Command;

class voteProtectionDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voteProtection:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete votes protection after 2 hours';

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
        VoteProtect::where('expiration', '<=', Carbon::now()->toDateTimeString())->each(function ($i) {
            $i->delete();
        });
    }
}
