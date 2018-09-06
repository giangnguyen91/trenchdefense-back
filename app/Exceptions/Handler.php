<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

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
     * Report or log an exception.
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        $message = $this->logInfo((string)$exception);
        \Log::error($message);
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->is('admin*')) {
            if (app()->isLocal() || app()->runningUnitTests()) {
                if (env('APP_DEBUG')) {
                    return parent::render($request, $exception);
                }
            }

            if ($exception instanceof ValidationException) {
                return $this->convertValidationExceptionToResponse($exception, $request);
            }

            return response('Whoops, looks like something went wrong.');
        } else {
            $error = $this->toProtobufError($exception);
            return response()->protobuf([
                $error->toProtobufModel()
            ], $error->getHttpStatusCode());
        }
    }

    /**
     * @param Exception $ex
     * @return Error
     */
    private function toProtobufError(Exception $ex)
    {
        switch (get_class($ex)) {
            case AuthenticationException::class:
            case \InvalidArgumentException::class:
                return new Error('Authenticate failed', $this->parseErrorCode($ex, 40101), $httpStatusCode = 401);
                break;
            default:
                return new Error('Internal server error', $this->parseErrorCode($ex, 50001), $httpStatusCode = 500);
        }
    }

    /**
     * @param string $message
     * @return string
     */
    private function logInfo(string $message)
    {
        $info = 'GameUserId=' . \Auth::id()
            . ' Method=' . \Request::method()
            . ' Path=' . \Request::path()
            . ' Host=' . \Request::getHost();
        $query = \Request::getQueryString();

        if ($query) {
            $info = $info . ' Query=' . $query;
        }

        try {
            $gitInfo = $this->getGitInfo();
        } catch (\Throwable $e) {
            logger()->error($e);
            $gitInfo = '';
        }
        $info .= $gitInfo;

        return $info . "\n" . $message;
    }

    /**
     * @return string
     */
    private function getGitInfo(): string
    {
        $headFilePath = base_path('.git/HEAD');
        if (!file_exists($headFilePath)) {
            return '';
        }
        $head = file_get_contents($headFilePath);
        if (!$head) {
            return '';
        }

        $branch = trim(str_replace('ref: refs/heads/', '', $head));

        $branchHeadRefPath = base_path(".git/refs/heads/{$branch}");
        if (!file_exists($branchHeadRefPath)) {
            return "\nBranch={$branch}";
        }

        $commitHash = file_get_contents($branchHeadRefPath);
        if (!$commitHash) {
            return "\nBranch={$branch}";
        }

        return "\nBranch={$branch} Commit={$commitHash}";
    }

    /**
     * @param Exception $exception
     * @param int $default
     * @return int
     */
    private function parseErrorCode(Exception $exception, int $default): int
    {
        $exceptionCode = $exception->getCode();

        if ($exceptionCode === 0) {
            return $default;
        }

        if (is_string($exceptionCode)) {
            $exceptionCode = 0;
        }

        return intval($exceptionCode);
    }
}
