<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
    use HasFactory;

    protected $fillable = ["name","description","productCode","image","stock","is_active","color","size","price","sale_price","categories_id",
    "sub_categories_id","brands_id"];



}
