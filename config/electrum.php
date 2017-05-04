<?php

return [
    'check_balance' => env('ELECTRUM_BALANCE', 'electrum getaddressbalance %s'),
    'paytomany' => env('ELECTRUM_PAYTOMANY', 'electrum paytomany %s | electrum broadcast -'),
];
