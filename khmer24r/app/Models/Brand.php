<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

     // protected $fillable = [
    //     'name',
    //     'icon',
    //     'seven'
    // ];

    //If you want to block all fields from being mass-assign you can just do this.
    protected $guarded = [];
}
