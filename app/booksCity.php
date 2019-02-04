<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booksCity extends Model
{
    protected $table = 'books_city';
    public $timestamps = false;
    public $fillable = [
        'id', 'city_name', 'code', 'country_id'];
    protected $primaryKey = 'id';
}
