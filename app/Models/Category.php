<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_name',
    ];

    // join table with orm
    // panggil di html
    // $category->user->name
    // data name->method name->field name
    public function user(){
        //return $this->hasOne(nama model::class, field db dari model yang dituju, field db dari table yang dipakai skrg);
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    
}
