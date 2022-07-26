<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Sector extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'sector_name',
        'parent_id',
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

    public function parent()
    {
        return $this->belongsTo(Sector::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Sector::class, 'parent_id');
    }

    public function projects(){
        return $this->hasMany(Project::class,'sector_id','id');
    }

    protected function iconName(): Attribute
    {
        $no_img = '/files/user_profiles/user-dummy-img.jpg';
        $profile_picture_url = '/files/sectors/';
        return Attribute::make(
            get: fn ($value) => ($value == '' || $value == null ) ? url($no_img) : url($profile_picture_url.$value),
        );
    }
}
