<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'sport_id', 'gender_id'];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function overallQuotas()
    {
        return $this->hasMany(OverallQuota::class);
    }
}
