<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function skills()
    {
        return $this->hasMany(Skills::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }
}
