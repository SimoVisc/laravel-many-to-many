<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['slug'];
    protected $appends = ['image_url'];

    protected function getImageUrlAttribute()
    {
        return $this->cover_image ? asset("storage/$this->cover_image") : "https://placeholder.com/assets/images/150x150-2-500x500.png";
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

}