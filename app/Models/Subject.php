<?php

namespace App\Models;

use App\Models\Mark;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name','code'];

    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_subject','subject_id')->withPivot('class');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
