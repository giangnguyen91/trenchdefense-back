<?php

namespace App\Domains\Base\ValueObject;

/**
 * @package App\Domains\Base
 */
class StringValueObject
{
    /**
     * @var string
     */
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param string $value
     * @return static
     */
    public function renew(string $value)
    {
        return new static($value);
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param StringValueObject $another
     * @return bool
     */
    public function equals(StringValueObject $another)
    {
        if (!$another instanceof static) {
            return false;
        }
        return $this->value === $another->value;
    }
}