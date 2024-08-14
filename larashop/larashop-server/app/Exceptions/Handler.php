<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
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

    /*
     * APIBusinessLogicExceptionはビジネスロジック中でのエラーなので、
     * Exceptionのログが出力されないようにする
     */
    protected $dontReport = [
        APIBusinessLogicException::class,
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (ValidationException $exception, $request) {
            $errors = [];
            foreach ($exception->errors() as $field => $error) {
                $field = preg_replace('/\.\d+$/', '', $field); // 配列の場合ひとまとめにする
                $errors[] = [
                    'field' => $field,
                    'detail' => $error[0],
                ];
            }

            return response()->json([
                'message' => '入力項目に誤りがあります。',
                'errors' => $errors,
            ], $exception->status);
        });

        $this->renderable(function (HttpException $exception, $request) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], $exception->getStatusCode());
        });

        $this->renderable(function (APIBusinessLogicException $exception, $request) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], $exception->getCode());
        });

    }
}
