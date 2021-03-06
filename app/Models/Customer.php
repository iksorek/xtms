<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
class Customer extends Model
{
    use HasFactory;
    use Uuids;

    protected $guarded = [];

    public function User()
    {
        $this->belongsTo(User::class);
    }

    public function Runs()
    {
        return $this->hasMany(Run::class);
    }
}
