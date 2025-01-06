<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name', 'building_id'];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class);
    }
}
