<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof NotFoundHttpException || $exception instanceof MethodNotAllowedHttpException) {
                return response()->json(['success' => FALSE, 'message' => 'Endpoint tidak ditemukan.'], 404);
            } else if ($exception instanceof AuthenticationException) {
                return response()->json(['success' => FALSE, 'message' => 'Sesi tidak valid. Silahkan login.'], 401);
            } else if ($exception instanceof AuthorizationException) {
                return response()->json(['success' => FALSE, 'message' => $exception->getMessage()], 403);
            } else if ($exception instanceof ValidationException) {
                $errors = [];
                foreach ($exception->errors() as $field => $message) {
                    $errors[$field] = $message[0];
                }
                return response()->json(['success' => FALSE, 'message' => 'Data yang dimasukkan tidak valid.', 'errors' => $errors], 422);
            } else if ($exception instanceof ModelNotFoundException) {
                return response()->json(['success' => FALSE, 'message' => 'Data tidak ditemukan.'], 404);
            } else if ($exception instanceof UnauthorizedException) {
                return response()->json(['success' => FALSE, 'message' => 'Akses ditolak.'], 403);
            } else {
                return response()->json(['success' => FALSE, 'message' => 'Terjadi kesalahan pada sistem.'], 500);
            }
        }

        return parent::render($request, $exception);
    }
}
