<?php

namespace App\Domains\Base\ValueObject;

/**
 * @package App\Domains\Base
 */
class FloatValueObject
{
    /**
     * @var float
     */
    protected $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return FloatValueObject
     */
    public function add(float $value): FloatValueObject
    {
        $addedValue = $this->value + $value;
        return new static($addedValue);
    }

    /**
     * @param float $value
     * @return FloatValueObject
     */
    public function subtract(float $value): FloatValueObject
    {
        $subtractedValue = $this->value - $value;
        return new static($subtractedValue);
    }
}