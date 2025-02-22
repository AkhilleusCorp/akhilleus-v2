<?php

namespace App\Domain\Factory;

use App\Domain\DTO\SourceModel\SourceModelInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SourceModelFactory
{
    use InferModelPropertiesTrait;

    public function __construct(private readonly ValidatorInterface $validator)
    {
    }

    /**
     * @param array<mixed> $parameters
     */
    public function buildSourceFromParameters(array $parameters, SourceModelInterface $source): SourceModelInterface
    {
        $this->inferFromParameters($parameters, $source);
        $errors = $this->validator->validate($source);

        $formattedErrors = [];
        if (0 < $errors->count()) {
            foreach ($errors as $error) {
                $formattedErrors[$error->getPropertyPath()] = $error->getMessage();
            }

            throw new BadRequestHttpException(json_encode($formattedErrors));
        }

        return $source;
    }
}
