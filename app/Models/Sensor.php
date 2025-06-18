<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sensor extends Model
{
    protected $table = 'sensors';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'topic',
        'unit',
        'description',
        'location',
        'kumbung_id',
    ];

    public function kumbung(): BelongsTo
    {
        return $this->belongsTo(Kumbung::class);
    }

    public function data(): HasMany
    {
        return $this->hasMany(Data::class);
    }

    public function actuator(): HasMany
    {
        return $this->hasMany(Actuator::class);
    }
}
