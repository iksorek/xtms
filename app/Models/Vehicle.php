<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Runs()
    {
        return $this->hasMany(Run::class);
    }
}
