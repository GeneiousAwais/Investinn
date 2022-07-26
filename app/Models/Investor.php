<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Investor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'about_me',
        'country_id',
        'investment_range_id',
        'picture',
        'user_id',
        "investment_on_behalf",
        "reason_to_join_c_hub",
        "venture_backed_experience",
        "interested",
        "terms_and_condition"

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

    public function sectors()
    {
        return $this->belongsTo(Sector::class, 'sector_id', 'id');
    }

    public function subSectors()
    {
        return $this->belongsTo(Sector::class, 'sub_sector_id', 'id');
    }

    public function investmentRanges()
    {
        return $this->belongsTo(InvestmentRange::class, 'investment_range_id', 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected function picture(): Attribute
    {
        $no_img = '/files/user_profiles/user-dummy-img.jpg';
        $profile_picture_url = '/files/investors_picture/';
        return Attribute::make(
            get: fn ($value) => ($value == '' || $value == null ) ? url($no_img) : url($profile_picture_url.$value),
        );
    }

    
}
