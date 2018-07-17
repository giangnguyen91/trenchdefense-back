<?php

namespace App\Domains\Base\ValueObject;

use PHPUnit\Framework\Assert;

/**
 * Stringのバリューオブジェクトのベース
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
     * 値でインスタンスを再生成する
     * @param string $value
     * @return static
     */
    public function renew(string $value)
    {
        return new static($value);
    }

    /**
     * プリミティブ値を取得する
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * 対象と比較する。
     * 一致しない場合は assert が発生する。
     * @param StringValueObject $actual
     */
    public function assertEquals(StringValueObject $actual)
    {
        Assert::assertEquals($this->value, $actual->value);
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