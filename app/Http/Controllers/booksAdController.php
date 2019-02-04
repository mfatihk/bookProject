<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;


use App\booksAd;

class booksAdController extends ApiController
{
    /**
    * @bodyParam user_id integer required -
    * @bodyParam trade_type_id integer required -
    * @bodyParam category_id integer required -
    * @bodyParam sub_category_id integer required -
    * @bodyParam starting_cost integer required -
    * @bodyParam exchange_book_name varchar if trade type is exchange
    * @bodyParam start_date integer if trade type is rent
    * @bodyParam end_date integer if trade type is rent
    * @bodyParam title integer  -
    * @bodyParam description integer  -
    */
    public function createAd(CreateAdPostRequest $request){
        $newAd = booksAd::create([
            'user_id' => $request['user_id'],
            'trade_type_id' => $request['trade_type_id'],
            'category_id' => $request['category_id'],
            'sub_category_id' => $request['sub_category_id'],
            'exchange_book_name' => $request['exchange_book_name'],
            'starting_cost' => $request['starting_cost'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'title' => $request['title'],
            'description' => $request['description'],
            'book_ad_state' => $request['book_ad_state'],
            'created_at' => now(),
        ]); 
        
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'ad' => $newAd,
            'message' => 'success'
        ]);
    }
    
    /**
    * @bodyParam user_id integer required -
    * @bodyParam trade_type_id integer required -
    * @bodyParam category_id integer required -
    * @bodyParam sub_category_id integer required -
    * @bodyParam starting_cost integer required -
    * @bodyParam exchange_book_name varchar if trade type is exchange
    * @bodyParam start_date integer if trade type is rent
    * @bodyParam end_date integer if trade type is rent
    * @bodyParam title integer  -
    * @bodyParam description integer  -
    */
    public function updateUserAd(UpdateUserAdPostRequest $request){
        $bookAd = booksAd::where('id', $request['id'])->first();
        
        foreach($bookAd->fillable as $field){
            if($request[$field] != null){
                $bookAd[$field] = $request[$field];
            }
        }
        $bookAd->updated_at = now();
        $bookAd->save();
        
        $showBookAd = booksAd::where('id', $request['id'])->first()->paginate();
        
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'offer' => $showBookAd,
            'message' => 'update successful!'
        ]);
    }
}
