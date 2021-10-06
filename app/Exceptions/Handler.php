<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Access\AuthorizationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */

     public function render($request, Throwable $exception)
      {
        if ($request->expectsJson() && $exception instanceof ModelNotFoundException) {
        return Route::respondWithRoute('api.fallback');
      }

    //   dd(get_class($exception));
    // standard authurization error
        if($request->expectsJson() && $exception instanceof AuthorizationException){
            return response()->json(
                ['message' => $exception->getMessage()], 403);
        }
        return parent::render($request, $exception);
      }

    // public function register()
    // {
    //     $this->reportable(function (Throwable $ex) {
    //         if ($ex instanceof ModelNotFoundException) {
    //             return Route::respondWithRoute('api.fallback');
    //         }
    //             return parent::report($ex);
    //     });
    // }
}
