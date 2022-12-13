<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $primaryKey = 'slug';
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function category ()
    {
        return $this->belongsTo(Category::class);
    }
}
