<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateQuota extends Model
{
    protected $fillable = ['overall_quota_id', 'state_id', 'min_quota', 'max_quota', 'reserve_quota'];

    public function overallQuota()
    {
        return $this->belongsTo(OverallQuota::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
