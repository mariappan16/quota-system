<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Sport extends Model
{
    protected $fillable = ['name'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function overallQuotas()
    {
        return $this->hasMany(OverallQuota::class);
    }
}
