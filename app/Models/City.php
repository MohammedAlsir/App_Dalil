<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Translatable\HasTranslations;


class City extends Model
{
    use HasFactory;
    // use HasTranslations;

    // public $translatable = ['name'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function hotel()
    {
        return $this->hasMany(Hotel::class);
    }
}