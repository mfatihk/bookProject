<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booksUser extends Model
{
    protected $table = 'books_user';
    public $timestamps = false;
    public $fillable = [
        'id', 'user_full_name', 'email', 'password', 'email_verified', 'rating', 'rating_count', 'phone_number', 
        'phone_country_code', 'phone_number_verified', 'profile_image_id', 'user_state', 'last_login_date', 'summary',
        'country_id', 'city_id', 'remember_token', 'sub_city_id', 'created_at', 'updated_at' 
        ];
    protected $primaryKey = 'id';
}
