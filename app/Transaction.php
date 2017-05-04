<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'owner_id',
        'wallet_address',
        'wallet_value',
        'client_address',
        'client_percent',
        'owner_percent',
        'float',
        'owner_value',
        'client_value',
        'command_successful',
        'command_output',
    ];

    public function clientSplit()
    {
        return $this->belongsTo(ClientSplit::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
