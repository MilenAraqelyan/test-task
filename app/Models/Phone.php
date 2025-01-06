<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = ['number', 'organization_id'];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
