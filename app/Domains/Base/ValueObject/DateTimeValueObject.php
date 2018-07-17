<?php

namespace App\Domains\Base\ValueObject;

use App\Domains\Base\Time\DateTime;
use PHPUnit\Framework\Assert;

/**
 * DateTimeのバリューオブジェクトのベース
 * @package App\Domains\Base
 */
class DateTimeValueObject
{
    /**
     * @var DateTime
     */
    protected $value;

    public function __construct(DateTime $value)
    {
        $this->value = $value;
    }

    /**
     * プリミティブ値を取得する
     * @return DateTime
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * 対象と比較する。
     * 一致しない場合は assert が発生する。
     * @param DateTimeValueObject $actual
     */
    public function assertEquals(DateTimeValueObject $actual)
    {
        Assert::assertEquals($this->value, $actual->value);
    }
}