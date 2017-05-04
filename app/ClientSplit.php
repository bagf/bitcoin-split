<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientSplit extends Model
{
    protected $fillable = ['wallet_address', 'wallet_value', 'client_address', 'client_percent', 'owner_percent', 'float'];
}
