<?php
namespace App\Domains\Base\ValueObject;
use App\Domains\Base\Time\DateTime;
use PHPUnit\Framework\Assert;
/**
 * null許可のCarbonのバリューオブジェクトのベース
 * @package App\Domains\Base
 */
class NullableDateTimeValueObject
{
    /**
     * @var DateTime
     */
    protected $value;

    public function __construct(DateTime $value = null)
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
     * 値でインスタンスを再生成する
     * @param DateTime|null $value
     * @return static
     */
    public function renew(DateTime $value = null)
    {
        return new static($value);
    }

    /**
     * 対象と比較する。
     * 一致しない場合は assert が発生する。
     * @param NullableDateTimeValueObject $actual
     */
    public function assertEquals(NullableDateTimeValueObject $actual)
    {
        Assert::assertEquals($this->value, $actual->getValue());
    }
}