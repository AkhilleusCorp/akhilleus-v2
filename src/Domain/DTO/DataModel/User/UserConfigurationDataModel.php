<?php

namespace App\Domain\DTO\DataModel\User;

use App\Domain\DTO\DataModel\DataModelInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name: 'USER_CONFIGURATION')]
class UserConfigurationDataModel implements DataModelInterface
{
    private const DEFAULT_DATE_FORMAT = 'd-m-Y h:i:s';
    private const DEFAULT_WEIGHT_UNIT = 'Kg';
    private const DEFAULT_DISTANCE_UNIT = 'Km';
    private const DEFAULT_MEASUREMENT_UNIT = 'cm';

    #[ORM\Id()]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type: Types::INTEGER)]
    public int $id;

    #[ORM\Column(type: Types::STRING, length: 20)]
    public string $dateFormat = self::DEFAULT_DATE_FORMAT;

    #[ORM\Column(type: Types::STRING, length: 20)]
    public string $weightUnit = self::DEFAULT_WEIGHT_UNIT;

    #[ORM\Column(type: Types::STRING, length: 20)]
    public string $distanceUnit = self::DEFAULT_DISTANCE_UNIT;
    #[ORM\Column(type: Types::STRING, length: 20)]
    public string $measurementUnit = self::DEFAULT_MEASUREMENT_UNIT;
}