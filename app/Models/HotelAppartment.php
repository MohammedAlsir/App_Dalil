<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Translatable\HasTranslations;

class HotelAppartment extends Model
{
    use HasFactory;
    // use HasTranslations;

    // public $translatable = ['name', 'floor', 'features'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function type_appartment()
    {
        return $this->belongsTo(TypeAppartment::class, 'type_appartment_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'appartment_id');
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'appartment_id');
    }
}