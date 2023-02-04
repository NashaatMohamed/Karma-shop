<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategories;
class Categories extends Model
{
    use HasFactory;
    protected $fillable = ["name","is_active"];

    public function SubCategories(){
    return $this->hasmany(SubCategories::class);
    }
}
