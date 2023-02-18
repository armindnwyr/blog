<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'url',
        'image',
        'publish',
        'user_id',
        'category_id',
        'update_at',
    ];

    // relacion uno a muchos inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    // relacion uno a muchos
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
