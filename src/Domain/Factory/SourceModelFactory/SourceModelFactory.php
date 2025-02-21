<?php

namespace App\Domain\Factory\SourceModelFactory;

use App\Domain\DTO\SourceModel\SourceModelInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class SourceModelFactory
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    /**
     * @param array<mixed> $parameters
     */
    public function buildSourceFromParameters(array $parameters, SourceModelInterface $source): SourceModelInterface
    {
        $this->inferSourceModel($parameters, $source);
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

    /**
     * @param array<mixed> $parameters
     */
    private function inferSourceModel(array $parameters, SourceModelInterface $source): void
    {
        foreach ($parameters as $key => $value) {
            if (property_exists($source, $key)) {
                $source->{$key} = $value;
            }
        }
    }
}
