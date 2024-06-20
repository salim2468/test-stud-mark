<?php

namespace App\Models;

use App\Models\Mark;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    
    protected $fillable = ['student_name'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
