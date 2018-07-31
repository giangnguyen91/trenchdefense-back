<?php

namespace App\Domains\User\Action;

use App\Domains\User\User;
use App\Exceptions\Error;

class LinkSocialResult
{
    /**
     * @var bool
     */
    private $isSuccess;

    /**
     * @var Error
     */
    private $error;

    /**
     * @var User
     */
    private $user;

    /**
     * @param bool $isSuccess
     * @param Error $error
     * @param User $user
     */
    public function __construct(
        bool $isSuccess = true,
        Error $error = null,
        User $user
    )
    {
        $this->isSuccess = $isSuccess;
        $this->error = $error;
        $this->user = $user;
    }

    /**
     * @return \App\Proto\LinkSocialResult
     */
    public function toProtobuf(): \App\Proto\LinkSocialResult
    {
        $model = new \App\Proto\LinkSocialResult();
        $model->isSuccess = $this->isSuccess;
        $model->error = !is_null($this->error) ? $this->error->toProtobufModel() : null;
        $model->user = $this->user->toProtobuf();
        return $model;
    }
}