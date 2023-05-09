<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NotFoundException.
 *
 */
class NotFoundException extends Exception
{

    public $httpStatusCode = Response::HTTP_NOT_FOUND;

    public $messageDefault = 'The requested resource was not found.';

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
        return response($this->getMessage()?? $this->messageDefault, $this->httpStatusCode);
    }

}
