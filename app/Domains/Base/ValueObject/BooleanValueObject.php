<?php

namespace App\Domains\Base\ValueObject;

/**
 * @package App\Domains\Base
 */
class BooleanValueObject
{
    /**
     * @var bool
     */
    protected $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param bool $value
     * @return BooleanValueObject
     */
    public function renew(bool $value): BooleanValueObject
    {
        return new static($value);
    }
}