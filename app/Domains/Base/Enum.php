<?php
namespace App\Domains\Base;

use PHPUnit\Framework\Assert;

abstract class Enum
{
    private $scalar;

    public function __construct($value)
    {
        $ref = new \ReflectionObject($this);
        $consts = $ref->getConstants();
        if (! in_array($value, $consts, true)) {
            $message = sprintf('%s は %sに定義されていない値です', $value, static::class);
            throw new \InvalidArgumentException($message);
        }

        $this->scalar = $value;
    }

    final public static function __callStatic($label, $args)
    {
        $class = get_called_class();
        $const = constant("$class::$label");
        return new $class($const);
    }

    final public function getValue()
    {
        return $this->scalar;
    }

    final public static function getConstList($class)
    {
        $reflect = new \ReflectionClass($class);
        $list = [];
        foreach ($reflect->getConstants() as $label => $value) {
            $list[] = new $class($value);
        }
        return $list;
    }

    final public static function getArray($class)
    {
        $reflect = new \ReflectionClass($class);
        return $reflect->getConstants();
    }

    final public function __toString()
    {
        return (string)$this->scalar;
    }

    /**
     * 対象と比較する。
     * 一致しない場合は assert が発生する。
     * @param Enum $actual
     */
    public function assertEquals(Enum $actual)
    {
        Assert::assertEquals($this->getValue(), $actual->getValue());
    }

    /**
     * 値でインスタンスを再生成する
     * @param mixed $value
     * @return static
     */
    public function renew($value)
    {
        return new static($value);
    }

    /**
     * 対象と一致するかどうかを返す
     * @param Enum $another
     * @return bool
     */
    public function equals(Enum $another): bool
    {
        if (static::class !== get_class($another)) {
            throw new \InvalidArgumentException('引数は' . static::class . 'クラスのオブジェクトである必要があります。');
        }
        return $this->getValue() === $another->getValue();

    }
}