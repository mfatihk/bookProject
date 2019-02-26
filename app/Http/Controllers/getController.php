<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\booksCountry;
use App\booksCity;
use App\booksSubCity;
use App\booksCategory;
use App\booksSubCategory;
use App\booksAd;


class getController extends ApiController
{
    public function getCountryNames(request $request){
        $countryNames = booksCountry::all();
        
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'country_names' => $countryNames,
            'message' => 'success'
        ]);
    }
    
    public function getCityNames(request $request){
        $cityNames = booksCity::all();
        
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'city_names' => $cityNames,
            'message' => 'success'
        ]);
    }
    
    public function getSubCityNames(request $request){
        $subCityNames = booksSubCity::all();
        
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'sub_city_names' => $subCityNames,
            'message' => 'success'
        ]);
    }
    
    public function getBookCategory(request $request){
        $category = booksCategory::all();
        
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'category' => $category,
            'message' => 'success'
        ]);
    }
    
    public function getBookSubCategory(request $request){
        $subCategories = booksSubCategory::all();
        
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'sub_category' => $subCategories,
            'message' => 'success'
        ]);
    }
    
    /**
    * @bodyParam book_name varchar required -
    */
    public function getBookAdByBookName(request $request){
        $books = booksAd::where('book_name', 'LIKE', '%'.$request['book_name'].'%')->get();
        
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'book_ad' => $books,
            'message' => 'success'
        ]);
    }
}
