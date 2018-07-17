<?php

namespace App\Domains\Base\ValueObject;

use PHPUnit\Framework\Assert;

/**
 * Boolのバリューオブジェクトのベース
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
     * プリミティブ値を取得する
     * @return bool
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * 対象と比較する。
     * 一致しない場合は assert が発生する。
     * @param BooleanValueObject $actual
     */
    public function assertEquals(BooleanValueObject $actual)
    {
        Assert::assertEquals($this->value, $actual->value);
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