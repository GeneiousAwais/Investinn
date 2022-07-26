<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;


class InvestorSector extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'sector_id',
        'sub_sector_id',
        'user_id',
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

     public function sectors()
    {
        return $this->belongsTo(Sector::class, 'sector_id', 'id');
    }

    public function subSectors()
    {
        return $this->belongsTo(Sector::class, 'sub_sector_id', 'id');
    }


}
