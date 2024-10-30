<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\support\Str;

class OfficeSpace extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'thumbnail',
        'is_open',
        'is_available',
        'price',
        'duration',
        'address',
        'description',
        'slug',
        'city_id',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        // $this->attributes['slug'] = strtolower($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function images():HasMany
    {
        return $this->hasMany(OfficeSpaceImage::class);
    }

    public function benefits() : HasMany
    {
        return $this->hasMany(OfficeSpaceBenefit::class);   
    }
    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class);   
    }
}
