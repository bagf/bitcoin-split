<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ClientSplit;

class UpdateWalletValue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:wallets';

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
        ClientSplit::all()->each(function (ClientSplit $cs) {
            $out = '';
            $return = null;
            exec($this->getBalance($cs->wallet_address), $out, $return);

            $string = implode("\n", $out);
            $data = json_decode($string, true);
            if (!is_array($data)) {
                logger()->error(__CLASS__." Failed to decode: {$string}");
                return ;
            }

            $cs->wallet_value = floatval(data_get($data, 'confirmed'));
            $cs->save();
        });
    }

    protected function getBalance($addresss)
    {
        return sprintf(config('electrum.check_balance'), $addresss);
    }
}
