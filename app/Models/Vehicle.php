<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    use Uuids;

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Runs()
    {
        return $this->hasMany(Run::class);
    }
    public function setRegAttribute($value)
    {
        $this->attributes['reg'] = strtoupper($value);
    }




}
