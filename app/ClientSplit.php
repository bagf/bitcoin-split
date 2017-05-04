<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientSplit extends Model
{
    protected $fillable = ['wallet_address', 'wallet_value', 'client_address', 'client_percent', 'owner_percent', 'float'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function createTransaction()
    {
        $attributes = array_except($this->getAttributes(), ['id', 'created_at', 'updated_at', 'deleted_at']);

        // Calculate payouts

        $cVal = $this->calcWalletPercent($this->client_percent);
        $oVal = $this->calcWalletPercent($this->owner_percent);

        $diff = ($this->wallet_value + $this->float) - ($cVal + $oVal);

        if ($diff > 0) {
            $adjust = $diff / 2;
            $cVal -= $adjust;
            $oVal -= $adjust;
        }

        $attributes['client_value'] = $cVal;
        $attributes['owner_value'] = $oVal;

        $this->transactions()->create($attributes);
    }

    private function calcWalletPercent($percent)
    {
        if ($percent <= 0) {
            return 0;
        }

        return $this->wallet_value * ($percent / 100);
    }
}
