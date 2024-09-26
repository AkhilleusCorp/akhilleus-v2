<?php

namespace App\Infrastructure\View\ViewModel\User;

use App\Infrastructure\View\ViewModel\SingleObjectViewModelInterface;
use Symfony\Component\Serializer\Attribute\Groups;

final class SingleUserViewModel implements SingleObjectViewModelInterface
{
    #[Groups('admin', 'member')]
    public int $id;

    #[Groups('admin', 'member')]
    public string $username;

    #[Groups('admin', 'member')]
    public string $email;

    #[Groups('admin', 'member')]
    public string $type;

    #[Groups('admin', 'member')]
    public string $status;
}