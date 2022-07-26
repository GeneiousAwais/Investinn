<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements MustVerifyEmail
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'password',
        'user_type_id',
        'user_name',
        'profile_picture',
        'email_verified_at',
        'is_approved',
        'approved_by',
        'is_active'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'comma_seperated_expertises',
    ];

    public function userTypes()
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

    protected function profilePicture(): Attribute
    {
        $no_img = '/files/user_profiles/user-dummy-img.jpg';
        $profile_picture_url = '/files/user_profiles/';
        return Attribute::make(
            get: fn ($value) => ($value == '' || $value == null ) ? url($no_img) : url($profile_picture_url.$value),
        );
    }

    public function investor(){
        return $this->hasOne(Investor::class,'user_id','id');
    }

    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value == 1) ? 'active' : 'inactive',
        );
    }

    public function expertises(){
        return $this->belongsToMany(Expertise::class,'user_expertises','user_id','expertise_id');
    }

    public function getCommaSeperatedExpertisesAttribute(){
        return implode(',',$this->expertises()->pluck('title')->toArray());
    }

    public function investor_sectors()
    {
        return $this->hasMany(InvestorSector::class,'user_id','id')->select(['user_id','sector_id'])->distinct();
    }

    public function project_investors()
    {
        return $this->hasMany(ProjectInvestor::class,'project_investor','id');
    }

    public function project_mentors()
    {
        return $this->hasMany(ProjectMentor::class,'project_mentor','id');
    }
    
    public function sdgs()
    {
        return $this->morphMany(ProjectSdg::class, 'commentable');
    }
}
