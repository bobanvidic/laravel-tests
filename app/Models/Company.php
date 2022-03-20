<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model {

    use HasFactory;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'country_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get all of the company emails.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function emails()
    {
        return $this->morphMany(EmailAddress::class, 'emailaddressable');
    }

    /**
     * Get all of the company phones.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function phones()
    {
        return $this->morphMany(PhoneNumber::class, 'phonenumberable');
    }
}
