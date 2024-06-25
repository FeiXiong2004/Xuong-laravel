<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Catalogues;
use App\Models\Tag;
class Products extends Model
{
    use HasFactory;

    protected $fillable =[
        'catalogues_id',
        'name',
        'slug',
        'sku',
        'img_thumbnail',
        'price_regular',
        'price__sale',
        'description',
        'content',
        'material',
        'user_manual',
        'is_active',
        'is_hot_deal',
        'is_good_deal',
        'is_new',
        'is_show_home',
       
    ];
    protected $casts =[
        'is_active' => 'boolean',
        'is_hot_deal' => 'boolean',
        'is_good_deal' => 'boolean',
        'is_new' => 'boolean',
        'is_show_home' => 'boolean',
     
    ];
    public  function catalogue(){
        return $this->belongsTo(Catalogues::class,'catalogues_id','id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,);
    }
}
