<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Run extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Uuids;
    protected $guarded = [];



    public function User(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Vehicle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function Customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function setPostcodeFromAttribute($value)
    {
        $this->attributes['postcode_from'] = strtoupper($value);
    }

    public function setPostcodeToAttribute($value)
    {
        $this->attributes['postcode_to'] = strtoupper($value);
    }

}
