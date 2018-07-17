<?php

namespace App\Domains\Base\ValueObject;

use PHPUnit\Framework\Assert;

/**
 * @package App\Domains\Base
 */
class NullableStringValueObject
{
    /**
     * @var string|null
     */
    protected $value;

    public function __construct(string $value = null)
    {
        $this->value = $value;
    }

    /**
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param NullableStringValueObject $actual
     */
    public function assertEquals(NullableStringValueObject $actual)
    {
        Assert::assertEquals($this->value, $actual->value);
    }
}