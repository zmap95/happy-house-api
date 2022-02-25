<?php

namespace App\Exceptions;

use App\Helps\ResponseData;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
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

    public function render($request, Throwable $e)
    {
        if ($request->is('api/*') || $request->wantsJson()) {
            // Define the response
            $response = (new ResponseData())->setStatus(false);

            // Default response of 400

            $status = 400;

            if ($e instanceof AuthenticationException) {
                $status = 401;
            }

            // If this exception is an instance of HttpException
            if ($this->isHttpException($e)) {
                // Grab the HTTP status code from the Exception
                $status = $e->getStatusCode();
            }

            // If the app is in debug mode
            if (config('app.debug')) {
                $response->setMessage($e->getMessage())->setData([
                    'errors' => $e instanceof ValidationException ? $e->errors() : [],
                    'exception' => get_class($e),
                    'trace' => $e->getTrace(),
                    'is_debug' => true,
                ]);

                return response()->json($response->getBodyResponse(), $status);
            }
            $response = $response->setMessage($e->getMessage())->setData([]);
            if ($e instanceof ValidationException) {
                $response = $response->setMessage($e->errors()->first())->setData([
                    'errors' => $e->errors()
                ]);
                $status = $e->getStatusCode();
            }
            // Return a JSON response with the response array and status code
            return response()->json($response->getBodyResponse(), $status);
        }

        return parent::render($request, $e);
    }
}
