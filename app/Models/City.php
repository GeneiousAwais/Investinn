<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class City extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'city_name',
        'is_active',
        'country_id'  
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function getFullNameAttribute()
    {
        return $this->FirstName. " " .$this->LastName;
    }

    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value == 1) ? 'active' : 'inactive',
        );
    }

}
