<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class InternalErrorException.
 *
 */
class InternalErrorException extends Exception
{

    public $httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

    public $message = 'Something went wrong!';
    
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Report or log an exception.
     *
     * @param Request $request Request
     *
     * @return void
     */
    public function render($request)
    {
        return response()->error($this->getMessage()?: $this->message, [], $this->httpStatusCode);
    }

}