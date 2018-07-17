<?php

namespace App\Domains\Base\ValueObject;

use App\Domains\Base\Time\Interval;
use PHPUnit\Framework\Assert;

/**
 * Intervalのバリューオブジェクトのベース
 * @package App\Domains\Base
 */
class IntervalValueObject
{
    /**
     * @var Interval
     */
    protected $value;

    public function __construct(Interval $value)
    {
        $this->value = $value;
    }

    /**
     * プリミティブ値を取得する
     * @return Interval
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * 対象と比較する。
     * 一致しない場合は assert が発生する。
     * @param IntervalValueObject $actual
     */
    public function assertEquals(IntervalValueObject $actual)
    {
        Assert::assertEquals($this->value, $actual->value);
    }
}