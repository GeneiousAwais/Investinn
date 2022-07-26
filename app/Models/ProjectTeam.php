<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectTeam extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'team_name',
        'team_role',
        'team_bio',
        'team_overview',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'project_id',
        'picture'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    protected function picture(): Attribute
    {
        $no_img = '/files/blogs/user-dummy-img.jpg';
        $blog_banner_url = '/files/project_teams/';
        return Attribute::make(
            get: fn ($value) => ($value == '' || $value == null ) ? url($no_img) : url($blog_banner_url.$value),
        );
    }

}
