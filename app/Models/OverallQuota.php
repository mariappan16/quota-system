<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverallQuota extends Model
{
    protected $fillable = ['sport_id', 'gender_id', 'category_id', 'min_quota', 'max_quota', 'reserve_quota'];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stateQuotas()
    {
        return $this->hasMany(StateQuota::class);
    }
}
