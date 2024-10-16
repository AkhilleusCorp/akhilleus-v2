<?php

namespace App\Infrastructure\View\ViewModel\User;

use App\Infrastructure\View\ViewModel\SingleObjectDataViewModelInterface;
use Symfony\Component\Serializer\Attribute\Groups;

final class SingleUserDataViewModel implements SingleObjectDataViewModelInterface
{
    #[Groups(['admin', 'member'])]
    public int $id;

    #[Groups(['admin', 'member'])]
    public string $username;

    #[Groups(['admin', 'member'])]
    public string $email;

    #[Groups(['admin', 'member'])]
    public string $type;

    #[Groups(['admin', 'member'])]
    public string $status;

    #[Groups(['admin', 'member'])]
    public \DateTimeImmutable $registrationDate;

    #[Groups(['admin'])]
    public \DateTimeImmutable $lastModificationDate;

    #[Groups(['admin'])]
    public ?\DateTimeImmutable $lastLoginDate;

    #[Groups(['admin', 'member'])]
    public ?\DateTimeImmutable $lastCompletedWorkoutDate;

    #[Groups(['admin', 'member'])]
    public string $dateFormat;

    #[Groups(['admin', 'member'])]
    public string $weightUnit;

    #[Groups(['admin', 'member'])]
    public string $distanceUnit;

    #[Groups(['admin', 'member'])]
    public string $measurementUnit;
}
