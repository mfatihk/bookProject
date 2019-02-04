<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Response;
use \Illuminate\Http\Response as Res;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;



class ApiController extends Controller
{
    private $app_secret = '';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        
        //$this->beforeFilter('auth', ['on' => 'post']);
        
    }

    private function preLoginSignatureCheck($request) {
        $this->app_secret = env('APP_SECRET', '');
        
        $timestamp = $request->header('Timestamp');
        $nonce = $request->header('Nonce');

        $signature = md5($timestamp . "*_/&" . $nonce . "*_/&" . $this->app_secret);

        return strtoupper($request['user_signature']) == strtoupper($signature);
    }

    private function afterLoginSignatureCheck($request) {
        $this->app_secret = env('APP_SECRET', '');
        
        $timestamp = $request->header('Timestamp');
        $nonce = $request->header('Nonce');
        try {
            $user = JWTAuth::toUser($request['remember_token']);
        } catch (JWTException $e) {
            //echo $e . "\n";
            return false;
        }
        
        $signature = md5($timestamp . "*_/&" . $nonce . "*_/&" . $this->app_secret."*_/&".$user->remember_token);
        echo $signature. "\n";
        
        return strtoupper($request['user_signature']) == strtoupper($signature);
    }

    protected function preLoginAuthendicate($request) {
        return $this->preLoginAuthendicate($request);
    }
    protected function afterLoginAuthendicate($request) {
        return $this->afterLoginSignatureCheck($request);
    }

    /**
     * @var int
     */
    protected $statusCode = Res::HTTP_OK;

    /**
     * @return mixed
     */
    public function getStatusCode() {
        return $this->statusCode;
    }

    /**
     * @param $message
     * @return json response
     */
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respondCreated($message, $data = null) {
        return $this->respond([
                    'status' => 'success',
                    'status_code' => Res::HTTP_CREATED,
                    'message' => $message,
                    'data' => $data
        ]);
    }

    /**
     * @param Paginator $paginate
     * @param $data
     * @return mixed
     */
    protected function respondWithPagination(Paginator $paginate, $data, $message) {
        $data = array_merge($data, [
            'paginator' => [
                'total_count' => $paginate->total(),
                'total_pages' => ceil($paginate->total() / $paginate->perPage()),
                'current_page' => $paginate->currentPage(),
                'limit' => $paginate->perPage(),
            ]
        ]);
        return $this->respond([
                    'status' => 'success',
                    'status_code' => Res::HTTP_OK,
                    'message' => $message,
                    'data' => $data
        ]);
    }

    public function respondNotFound($message = 'Not Found!') {
        return $this->respond([
                    'status' => 'error',
                    'status_code' => Res::HTTP_NOT_FOUND,
                    'message' => $message,
        ]);
    }

    public function respondInternalError($message) {
        return $this->respond([
                    'status' => 'error',
                    'status_code' => Res::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => $message,
        ]);
    }

    public function respondValidationError($message, $errors) {
        return $this->respond([
                    'status' => 'error',
                    'status_code' => Res::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => $message,
                    'data' => $errors
        ]);
    }

    public function respond($data, $headers = []) {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message) {
        return $this->respond([
                    'status' => 'error',
                    'status_code' => Res::HTTP_UNAUTHORIZED,
                    'message' => $message,
        ]);
    }

}
