<?php

namespace App\Infrastructure\ApiDoc;

use OpenApi\Attributes\Property;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::IS_REPEATABLE)]
final class Parameter extends Property
{
    /**
     * @param string[] $enum
     */
    public function __construct(?array $enum = null)
    {
        parent::__construct(enum: $enum);
    }
}
