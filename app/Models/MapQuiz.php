<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MapQuiz extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];
    protected $appends = ['image'];

    public function getImageAttribute(){
        return $this->getFirstMediaUrl('images');
    }
    public function questions(): HasMany
    {
        return $this->hasMany(MapQuestion::class);
    }

}
