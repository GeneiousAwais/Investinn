<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectDocument extends Model
{
    use HasFactory, SoftDeletes;
     protected $fillable = [
        'business_case',
        'slide_deck',
        'financial_documents',
        'project_id'
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
    

    protected function businessCase(): Attribute
    {
        $no_img = '/files/user_profiles/user-dummy-img.jpg';
        $profile_picture_url = '/files/project_details_files/';
        return Attribute::make(
            get: fn ($value) => ($value == '' || $value == null ) ? url($no_img) : url($profile_picture_url.$value),
        );
    }

    protected function slideDeck(): Attribute
    {
        $no_img = '/files/user_profiles/user-dummy-img.jpg';
        $profile_picture_url = '/files/project_details_files/';
        return Attribute::make(
            get: fn ($value) => ($value == '' || $value == null ) ? url($no_img) : url($profile_picture_url.$value),
        );
    }

    protected function financialDocuments(): Attribute
    {
        $no_img = '/files/financial_documents_files/user-dummy-img.jpg';
        $profile_picture_url = '/files/financial_documents_files/';
        return Attribute::make(
            get: fn ($value) => ($value == '' || $value == null ) ? url($no_img) : url($profile_picture_url.$value),
        );
    }
}
