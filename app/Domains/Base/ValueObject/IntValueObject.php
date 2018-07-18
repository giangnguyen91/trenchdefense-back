<?php

namespace App\Domains\Base\ValueObject;

/**
 * @package App\Domains\Base
 */
class IntValueObject
{
    /**
     * @var int
     */
    protected $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * プリミティブ値を取得する
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return IntValueObject
     */
    public function add(int $value): IntValueObject
    {
        $addedValue = $this->value + $value;
        return new static($addedValue);
    }

    /**
     * @param int $value
     * @return IntValueObject
     */
    public function subtract(int $value): IntValueObject
    {
        $subtractedValue = $this->value - $value;
        return new static($subtractedValue);
    }

    /**
     * @param int $value
     * @return IntValueObject
     */
    public function renew(int $value): IntValueObject
    {
        return new static($value);
    }

    /**
     * @param IntValueObject $another
     * @return bool
     */
    public function equals(IntValueObject $another)
    {
        if (!$another instanceof static) {
            return false;
        }
        return $this->value === $another->value;
    }
}
