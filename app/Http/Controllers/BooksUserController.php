<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use \App\booksUser;
use App\booksAddress;


class BooksUserController extends ApiController
{
    /**
    * @bodyParam remember_token text required -
    * @bodyParam per_page integer  -
    */
    public function getUserAllDetails(request $request){
        $user = JWTAuth::toUser($request['remember_token']);
        $per_page = $request['per_page'] == null ? 50 : $request['per_page'];
        
        $userInformation = booksUser::where('books_user.id', $user->id)
            ->leftJoin('books_country', 'books_country.id', '=', 'books_user.country_id')
            ->leftJoin('books_city', 'books_city.id', '=', 'books_user.city_id')
            ->leftJoin('books_sub_city', 'books_sub_city.id', '=', 'books_user.sub_city_id')
            ->leftJoin('books_image', 'books_image.id', '=', 'books_user.profile_image_id')
            //->leftJoin('books_book_category', 'books_book_category.id', '=', 'books_user.job_category_id')
            //->leftJoin('books_book_sub_category', 'books_book_sub_category.id', '=', 'books_user.job_category_id')
                
            ->select('books_user.user_name', 'books_user.user_surname', 'books_user.email', 'books_user.profession', 'books_user.last_location_lat', 'books_user.last_location_long', 
                    'books_user.rating', 'books_user.rating_count', 'books_user.phone_number', 'books_user.summary', 'books_user.user_profession', 'books_user.user_web_site',
                    'books_country.country_name', 'books_city.city_name', 'books_sub_city.sub_city_name', 
                    'books_image.full_size_image_url as profile_full_size_image', 'books_image.medium_size_image_url as profile_medium_size_image',
                    'books_image.thumbnail_size_image_url as profile_thumbnail_size_image')->paginate($per_page);
        $userSkill = booksAddress::where('user_id', $user->id)
            ->leftJoin('n2m_user', 'n2m_user.id', '=', 'n2m_user_skill.user_id')
            ->select('n2m_user_skill.title as user_skill', 'n2m_user.user_name', 'n2m_user.user_surname')->paginate($per_page);
        $userLanguage = SIUserLanguage::where('user_id', $user->id)
            ->leftJoin('n2m_user', 'n2m_user.id', '=', 'si_user_language.user_id')
            ->leftJoin('si_language', 'si_language.id', '=', 'si_user_language.language_id')
            ->select('si_user_language.language_level', 'n2m_user.user_name', 'n2m_user.user_surname', 'si_language.language')->paginate($per_page);
        $userInterest = N2MUserInterest::where('user_id', $user->id)
            ->leftJoin('n2m_user', 'n2m_user.id', '=', 'n2m_user_interest.user_id')
            ->leftJoin('n2m_job_category', 'n2m_job_category.id', '=', 'n2m_user_interest.category_id')
            ->select('n2m_job_category.title as user_interest', 'n2m_user.user_name', 'n2m_user.user_surname')->paginate($per_page);
        $userExperience = SIUserExperience::where('user_id', $user->id)
            ->leftJoin('n2m_user', 'n2m_user.id', '=', 'si_user_experience.user_id')
            ->leftJoin('si_working_place', 'si_user_experience.working_place_id', '=', 'si_working_place.id')
            ->leftJoin('si_working_position', 'si_user_experience.working_position_id', '=', 'si_working_position.id')
            ->leftJoin('n2m_document_image', 'si_user_experience.document_image_id', '=', 'n2m_document_image.id')
            ->select('si_user_experience.start_date', 'si_user_experience.end_date', 'n2m_user.user_name', 'n2m_user.user_surname', 'si_working_place.title as working_place', 'si_working_position.title as working_position',
                    'n2m_document_image.full_size_image_url', 'n2m_document_image.medium_size_image_url', 'n2m_document_image.thumbnail_size_image_url')->paginate($per_page);
        $userEducation = SIUserEducation::where('user_id', $user->id)
            ->leftJoin('n2m_user', 'n2m_user.id', '=', 'si_user_education.user_id')
            ->leftJoin('si_educational_place', 'si_user_education.education_place_id', '=', 'si_educational_place.id')
            ->leftJoin('si_education_type', 'si_user_education.education_type_id', '=', 'si_education_type.id')
            ->leftJoin('n2m_document_image', 'si_user_education.document_image_id', '=', 'n2m_document_image.id')
            ->select('si_user_education.start_date', 'si_user_education.end_date', 'si_user_education.grade', 'n2m_user.user_name', 'n2m_user.user_surname', 'si_educational_place.title as education_place', 'si_education_type.title as education_type', 
                    'n2m_document_image.full_size_image_url', 'n2m_document_image.medium_size_image_url', 'n2m_document_image.thumbnail_size_image_url')->paginate($per_page);
        //$userComment = N2MUserComment::where('commenter_user_id', $user->id)->paginate($per_page);
        //$userGallery = N2MUserGallery::where('user_id', $user->id)->paginate($per_page);
        
        //SIUserEducation::where('id', $user->id)->
                
        $user['visit_count'] = $user['visit_count']+=1;
        $user->updated_at = now();
        $user->save();
                
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'user_information' => $userInformation,
            'user_skill' => $userSkill,
            'user_language' => $userLanguage,
            'user_interest' => $userInterest,
            'user_experience' => $userExperience,
            'user_education' => $userEducation,
            //'user_comment' => $userComment,
            //'user_gallery' => $userGallery,
            'message' => 'success'
        ]);
    }
    
}
