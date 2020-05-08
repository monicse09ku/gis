<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiBaseController extends Controller
{
    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * NOT FOUND RESPONSE
     * @param  string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondError($message);
    }

    /**
     * UNPROCESSABLE ENTITY
     * @param  string $message
     * @return mixed
     */
    public function respondValidationError($message = 'Parameters failed validation error!')
    {
        return $this->setStatusCode(422)->respondError($message);
    }

    /**
     * UNAUTHORIZED RESPONSE
     * @param  string $message
     * @return mixed
     */
    public function respondUnauthorized($message = 'These credentials do not match our records.')
    {
        return $this->setStatusCode(API_RESPONSE_UNAUTHORIZED)->respondError($message);
    }

    /**
     * INTERNAL SERVER ERROR
     * @param  string $message
     * @return mixed
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(500)->respondError($message);
    }

    /**
     * COMMON SUCCESS RESPONSE
     * @param  array $data
     * @param  array  $headers
     * @return Illuminate\Http\Response
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * RESPONSE WITH COLLECTIONS WITH ADDITIONAL PARAMETER
     * @param  collection $data
     * @return mixed
     */
    public function respondWitCollection($data)
    {
        return $data;
        //->additional(['status_code' => $this->getStatusCode(),]);
    }

    /**
     * COMMON ERROR RESPONSE
     * @param  string $message
     * @return mixed
     */
    public function respondError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * COMMON SUCCESS RESPONSE
     * @param  string $message
     * @return mixed
     */
    public function respondSuccess($message)
    {
        return $this->respond([
            'message' => $message,
            'status_code' => $this->getStatusCode()
        ]);
    }

    /**
     * GET CURRENT LOGGEDIN USER
     * @return collection
     */
    public function currentUser()
    {
        $user = auth()->user();
        //
        //$user->load('userProfile.userLocation');
        return $user;
    }

    /**
     * Create auth user access token
     * @param  Object $user
     * @return Token
     */
    public function createAccessToken($user = null)
    {
        $user = $user ?: auth()->user();
        $this->deleteAccessToken();
        return (!empty($user)) ? $user->createToken($user->name)->accessToken : false;
    }

    /**
     * Delete exists auth user access token
     * @return Boolean
     */
    public function deleteAccessToken()
    {
        return \DB::table('oauth_access_tokens')->where('user_id', optional(auth()->user())->id)->delete();
    }
}
