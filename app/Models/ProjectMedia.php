<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectMedia extends Model
{
   use HasFactory, SoftDeletes;
    protected $fillable = [
        'picture',
        'video_link',
        'project_id',
        'is_featured'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    protected $appends = ['picture_url'];

    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    // protected function picture(): Attribute
    // {
    //     $no_img = '/files/blogs/user-dummy-img.jpg';
    //     $blog_banner_url = '/files/project_media/';
    //     return Attribute::make(
    //         get: fn ($value) => ($value == '' || $value == null ) ? url($no_img) : url($blog_banner_url.$value),
    //     );
    // }

    public function getPictureUrlAttribute(){
        $media_picture_url = '/files/project_media/';

        return !empty($this->picture) ? url($media_picture_url.$this->picture) : '';
    }

}
