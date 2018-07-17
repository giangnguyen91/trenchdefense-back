<?php

namespace App\Domains\Base\ValueObject;

use PHPUnit\Framework\Assert;

/**
 * Floatのバリューオブジェクトのベース
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
     * プリミティブ値を取得する
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

    /**
     * 対象と比較する。
     * 一致しない場合は assert が発生する。
     * @param FloatValueObject $actual
     */
    public function assertEquals(FloatValueObject $actual)
    {
        Assert::assertEquals($this->value, $actual->value);
    }
}