<?php

namespace App\Infrastructure\ApiDoc;

use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD | \Attribute::TARGET_PROPERTY | \Attribute::TARGET_PARAMETER | \Attribute::IS_REPEATABLE)]
final class QueryParameters extends OA\RequestBody
{
    public function __construct(
        string $dataClass,
        bool $required = false,
    ) {
        parent::__construct(required: $required, content: new OA\JsonContent(ref: new Model(type: $dataClass)));
    }
}
