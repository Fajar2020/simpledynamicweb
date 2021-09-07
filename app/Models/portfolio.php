<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portfolio extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'folio_name',
        'image',
        'short_desc'
    ];

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
