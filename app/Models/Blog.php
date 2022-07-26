<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Blog extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'title',
        'published_by',
        'description',
        'featured_image',
        'meta_tags',
        'meta_description',
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

    protected function featuredImage(): Attribute
    {
        $no_img = '/files/blogs/user-dummy-img.jpg';
        $blog_banner_url = '/files/blogs/';
        return Attribute::make(
            get: fn ($value) => ($value == '' || $value == null ) ? url($no_img) : url($blog_banner_url.$value),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'published_by', 'id');
    }
}
