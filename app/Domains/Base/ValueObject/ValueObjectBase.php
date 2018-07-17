<?php

namespace App\Domains\Base\ValueObject;

use App\Domains\Base\DomainBase;

/**
 * Class ValueObjectBase
 *
 * @package App\Domains\Base
 */
abstract class ValueObjectBase extends DomainBase
{
    /**
     * @return mixed
     */
    abstract function getValue();
}