<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booksCountry extends Model
{
    protected $table = 'books_country';
    public $timestamps = false;
    public $fillable = [
        'id', 'country_name', 'code'];
    protected $primaryKey = 'id';
}
