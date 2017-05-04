<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ClientSplit;
use Carbon\Carbon;

class PayoutMonthly extends Command
{
    use PayoutTrait;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payout:monthly';

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
     * @return mixed
     */
    public function handle()
    {
        ClientSplit::where('payout_frequency', 'MONTHLY')->get()->each(function (ClientSplit $cs) {
            // check if there was a successful transaction last week
            $transaction = $cs->transactions()->where('command_successful', 1)->whereRaw("DATE(created_at) >= DATE('".Carbon::now()->subMonth()->addDay()."')")->get()->first();
            if (!is_null($transaction)) {
                logger()->info("Skipping monthly for {$cs->id} because {$transaction->id} exists");
                return ;
            }

            $this->transfer($cs);
        });
    }
}
