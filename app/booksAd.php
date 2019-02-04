<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booksAd extends Model
{
    protected $table = 'books_ad';
    public $timestamps = false;
    public $fillable = [
        'id', 'user_id', 'trade_type_id', 'category_id', 'sub_category_id', 'exchange_book_name', 
        'starting_cost', 'start_date', 'end_date', 'book_name', 'description', 'book_ad_state', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
}
