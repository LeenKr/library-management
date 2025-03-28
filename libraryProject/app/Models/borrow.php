<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class borrow extends Model
{
    //
    protected $table = 'borrow';
    protected $fillable = ['book_id', 'name', 'email', 'password'];
}
