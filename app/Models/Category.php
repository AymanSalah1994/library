<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ] ;


    // category belognsToMany books
    public function books() {
        return $this->belongsToMany('App\Models\Book') ; 
    }
}

// this is what we will do now for it  ;
