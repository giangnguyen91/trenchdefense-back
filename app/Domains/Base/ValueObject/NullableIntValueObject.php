<?php

namespace App\Domains\Base\ValueObject;

use PHPUnit\Framework\Assert;

/**
 * @package App\Domains\Base
 */
class NullableIntValueObject
{
    /**
     * @var int|null
     */
    protected $value;

    public function __construct(int $value = null)
    {
        $this->value = $value;
    }

    /**
     * @return int|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param NullableIntValueObject $another
     * @return bool
     */
    public function equals(NullableIntValueObject $another)
    {
        if (!$another instanceof static) {
            return false;
        }
        return $this->value === $another->value;
    }
}