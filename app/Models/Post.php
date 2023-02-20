<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

use function PHPUnit\Framework\returnSelf;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'summary',
        'description',
        'url',
        'image',
        'publish',
        'user_id',
        'category_id',
        'update_at',
    ];

    protected $casts = [
        'publish' => 'boolean',
        'update_at' => 'datetime',
    ];
    public function imageReplace(): Attribute
    {
        return new Attribute(
            get: function(){
                
                $searc = public_path().$this->image;
                // return $this->image ?? asset('image/replace.jpg');
                //  dd($searc, 'public'.$this->image);
                // dd($searc);
                if(@getimagesize($searc))
                    return $this->image;
                else
                    return  asset('image/replace.jpg');
                
                // if ('https://via.placeholder.com/'.$this->image)
                //     return $this->image;
                    
                //     return asset('image/replace.jpg');
                // else
                
                // else
                //     return asset('image/replace.jpg');
                    // return $this->image ?? asset('image/replace.jpg');
            }
        );
    }
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

    public function getRouteKeyName(){

        return 'slug';
    }
}
