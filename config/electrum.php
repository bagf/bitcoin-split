<?php

return [
    'dryrun' => env('ELECTRUM_DRYRUN', true),
    'check_balance' => env('ELECTRUM_BALANCE', 'electrum getaddressbalance %s'),
    'paytomany' => env('ELECTRUM_PAYTOMANY', 'electrum paytomany %s | electrum broadcast -'),
];
