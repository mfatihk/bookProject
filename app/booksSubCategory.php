<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booksSubCategory extends Model
{
    protected $table = 'books_book_sub_category';
    public $timestamps = false;
    public $fillable = [
        'id', 'title', 'description', 'category_id', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
}
