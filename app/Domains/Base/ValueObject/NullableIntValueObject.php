<?php

namespace App\Domains\Base\ValueObject;

use PHPUnit\Framework\Assert;

/**
 * Intのバリューオブジェクトのベース
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
     * プリミティブ値を取得する
     * @return int|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * 対象と比較する。
     * 一致しない場合は assert が発生する。
     * @param NullableIntValueObject $actual
     */
    public function assertEquals(NullableIntValueObject $actual)
    {
        Assert::assertEquals($this->value, $actual->value);
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