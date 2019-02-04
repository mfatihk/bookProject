<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booksCategory extends Model
{
    protected $table = 'books_book_category';
    public $timestamps = false;
    public $fillable = [
        'id', 'title', 'description', 'provider_count', 'sub_category_count', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
}
