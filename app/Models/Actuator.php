<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Actuator extends Model
{
    protected $table = 'actuators';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    public function sensor(): BelongsTo
    {
        return $this->belongsTo(Sensor::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
