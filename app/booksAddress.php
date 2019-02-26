<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booksAddress extends Model
{
    protected $table = 'books_address';
    public $timestamps = false;
    public $fillable = [
        'id', 'title', 'description', 'address', 'building_no', 'door_no', 'floor',
        'active', 'user_id', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';
}
