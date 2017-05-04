<?php

namespace App\Console\Commands;

use App\ClientSplit;
use Exception;

trait PayoutTrait {
    protected function transfer(ClientSplit $clientSplit)
    {
        $transaction = $clientSplit->createTransaction();

        try {
            $payments = [];
            if ($transaction->client_value > 0) {
                $payments[] = [
                    $transaction->client_address."", $transaction->client_value,
                ];
            }
            if ($transaction->owner_value > 0) {
                $payments[] = [
                    $transaction->owner->wallet_addr."", $transaction->owner_value,
                ];
            }

            if (!count($transaction)) {
                logger()->info(__CLASS__." Nothing to transact for {$transaction->id}");
                return $transaction;
            }

dd($payments);
//            $out = '';
//            $return = null;
//            exec($this->paytomany($payments), $out, $return);
//            $string = implode("\n", $out);
//            $transaction->command_successful = $return;
//            $transaction->command_output = $string;
            $transaction->save();
        } catch (Exception $ex) {
            $transaction->command_successful = 0;
            $transaction->command_output = 'PHP Exception: '. get_class($ex).' '. $ex->getMessage();
            $transaction->save();
        }
    }

    private function paytomany($payments)
    {
        return sprintf(config('electrum.paytomany'), json_encode($payments));
    }
}