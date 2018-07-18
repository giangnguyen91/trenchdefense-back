<?php

namespace App\Exceptions;

class Error
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $message;

    /**
     * @var int
     */
    private $errorCode;

    /**
     * @var int
     */
    private $httpStatusCode;

    /**
     * Error constructor.
     * @param string $message
     * @param int $errorCode
     * @param int $httpStatusCode
     */
    public function __construct(
        string $message = '',
        int $errorCode = 50001,
        int $httpStatusCode = 500
    ) {
        $this->id = sha1(microtime(true) . random_int(0, mt_getrandmax()));
        $this->message = $message;
        $this->errorCode = $errorCode;
        $this->httpStatusCode = $httpStatusCode;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * @return int
     */
    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    /**
     * @return \App\Proto\Error
     */
    public function toProtobufModel()
    {
        $error = new \App\Proto\Error();
        $error->id = $this->id;
        $error->code = $this->errorCode;
        $error->message = $this->message;
        return $error;
    }
}
