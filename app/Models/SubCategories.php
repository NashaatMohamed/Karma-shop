<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class SubCategories extends Model
{
    use HasFactory;
    protected $fillable = ["name","is_active","categories_id"];

    public function Categories(){
        return $this->belongsto(Categories::class);
    }

}
