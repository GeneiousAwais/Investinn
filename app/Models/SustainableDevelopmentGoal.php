<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SustainableDevelopmentGoal extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'sdg_name',
        'icon_name',
        'is_active'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value == 1) ? 'active' : 'inactive',
        );
    }
    protected function iconName(): Attribute
    {
        $no_img = '/files/user_profiles/user-dummy-img.jpg';
        $profile_picture_url = '/files/sdg/';
        return Attribute::make(
            get: fn ($value) => ($value == '' || $value == null ) ? url($no_img) : url($profile_picture_url.$value),
        );
    }
}
