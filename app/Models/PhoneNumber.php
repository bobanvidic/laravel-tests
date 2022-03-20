<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model {

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'phone',
        'phonenumberable_type',
        'phonenumberable_id',
    ];

    /**
     * Get all of the owning phonenumberable models
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function phonenumberable()
    {
        return $this->morphTo();
    }
}
