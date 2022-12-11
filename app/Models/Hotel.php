<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

// use Spatie\Translatable\HasTranslations;


class Hotel extends Model
{
    use HasFactory;
    // use HasTranslations;

    // public $translatable = ['name', 'features'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function appartment()
    {
        return $this->hasMany(HotelAppartment::class);
    }

    public function like()
    {
        return $this->hasMany(Like::class);
    }

    // public function liked()
    // {
    //     return $this->hasMany(Like::class)->where('user_id', Auth::user()->id);
    // }

    public function images()
    {
        return $this->hasMany(Image::class, 'hotel_id');
    }

    // public function getNameAttribute($value)
    // {
    //     // if (\Request::route()->getPrefix() === 'api/v1')
    //     return $this->{"ar"};
    //     // return $this->setTranslations('name', 'ar');

    //     // else
    //     //     return $value;
    //     // if (
    //     //     \request()::route()->getName() == 'api'
    //     // ) {
    //     //     return $this->{'name_' . App()->getLocale()};
    //     // }
    // }
}