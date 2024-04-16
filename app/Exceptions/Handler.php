<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // function render($request, Throwable $e)
    // {
    //     if ($this->isHttpException($e)) {
    //         $statusCode = $e->getStatusCode();

    //         switch ($statusCode) {
    //             case '401':
    //                 return response()->view('errors.401', [], 401);
    //             case '403':
    //                 return response()->view('errors.403', [], 403);
    //             case '404':
    //                 return response()->view('errors.404', [], 404);
    //             case '500':
    //                 return response()->view('errors.500', [], 500);
    //             default:
    //                 return $this->convertExceptionToResponse($e);
    //         }
    //     }

    //     return parent::render($request, $e);
    // }
}
