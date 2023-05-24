<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MapQuestion extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
        protected $appends = ['image'];

    public function getImageAttribute(){
        return $this->getFirstMediaUrl('images');
    }
    protected $guarded = [];

}
