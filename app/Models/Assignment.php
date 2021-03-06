<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $guarded = [];

    // an assignment belongs to a course 
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // an assignment has many files
    public function files()
    {
        return $this->hasMany(File::class);
    }

    // This is the pivot table connection with User model
    public function users()
    {
    	return $this->belongsToMany(User::class);
    }

    public function getImageAttribute($value)
     {
     return asset('storage/' . $value);
     }
      public function getAvatarAttribute($value)
     {
     return asset('storage/' . $value);
     }

}
