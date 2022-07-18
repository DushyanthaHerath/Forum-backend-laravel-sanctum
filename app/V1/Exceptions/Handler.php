<?php

namespace App\V1\Exceptions;

use App\V1\Facades\API;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\Types\False_;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler
{
    /**
     * @param $request
     * @param Throwable $exception
     * @return false|\Illuminate\Http\JsonResponse
     */
    public static function render($request, \Throwable $exception) {
        //Exception handler function for API
        // If the app is in debug mode
        if ($request->wantsJson()) {
            //Unauthenticated
            if ($exception instanceof AuthenticationException || $exception instanceof oAuthValidationException) {
                $error = ['reference' => API_ERROR_CODE_AUTHENTICATION];
                return API::response(401, $exception->getMessage(), [], $error);
            }

            $code = $exception->getCode() ?: 500;
            $error = API_ERROR_CODE_GENERAL; // Sample : Proper codes should be allocated


            if (config('app.debug')) {

                $response = $exception->getMessage();
                $debug = $exception->getTrace();

                if ($exception instanceof QueryException) {
                    $code = 500;
                }

                return api()->error(
                    $response,
                    $debug
                );
            } else {

                $message = "Something went wrong, Please try again later.";

                if ($exception instanceof ApiException) {
                    return API::response($exception->getCode(), $exception->getMessage(), [], $error);
                }

                if ($exception instanceof ValidationException) {
                    //dd($exception->getCode(), $exception->getMessage(), $exception->errors(), $error);
                    return API::response(422, $exception->getMessage(), $exception->errors());
                }

                if ($exception instanceof PostTooLargeException) {
                    return API::response(422, "Maximum File Size Exceeded. Please upload a file sized below " . MAX_FILE_SIZE . "MB.", [], $error);
                }

                if ($exception instanceof AlreadyExistException) { //AlreadyExist Exception
                    return API::response(200, $exception->getMessage(), [], $error);
                }

                if ($exception instanceof MethodNotAllowedHttpException) { // MethodNotAllowed Exception
                    return API::response($exception->getCode(), $exception->getMessage(), [], $error);
                }

                if ($exception instanceof BadRequestApiException) { // Bad Request Exception
                    return API::response($exception->getCode(), $exception->getMessage(), [], $error);
                }

                if ($exception instanceof QueryException) {
                    // Exception Code
                    $message = "Server Error! Please Try Again.";
                }

                // Default
                return API::response($code, $message, [], ['CODE' => $error]);
            }
        }

        if($exception instanceof MethodNotAllowedHttpException){
            $message ='Method not allowed';
            // Exception Code
            $error = ['CODE' => API_ERROR_CODE_METHOD_NOT_ALLOWED];
            return API::response(405, 'Method not allowed',  [], $error);
        }

        return false;
    }
}
