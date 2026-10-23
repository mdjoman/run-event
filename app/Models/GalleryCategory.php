<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    protected $fillable = ['name', 'slug'];

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'category', 'slug');
    }
}
