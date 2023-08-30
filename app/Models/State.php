<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['name'];

    public function stateQuotas()
    {
        return $this->hasMany(StateQuota::class);
    }
}
