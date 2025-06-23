<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kumbung extends Model
{
    protected $table = 'kumbungs';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sensors(): HasMany
    {
        return $this->hasMany(Sensor::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
