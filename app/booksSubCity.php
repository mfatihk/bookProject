<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booksSubCity extends Model
{
    protected $table = 'books_sub_city';
    public $timestamps = false;
    public $fillable = [
        'id', 'sub_city_name', 'code', 'city_id'];
    protected $primaryKey = 'id';
}
