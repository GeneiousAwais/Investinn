<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CompanyEntrepreneur extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'company_name',
        'website_link',
        'contact_person',
        'email',
        'phone_no',
        'designation',
        'logo',
        'user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'date:d M, Y H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected function logo(): Attribute
    {
        $no_img = '/files/contact_us_files/user-dummy-img.jpg';
        $profile_picture_url = '/files/entrepreneur-company/';
        return Attribute::make(
            get: fn ($value) => ($value == '' || $value == null ) ? url($no_img) : url($profile_picture_url.$value),
        );
    }
}
