<?php

namespace App\Infrastructure\View\ViewModel\User;

use App\Infrastructure\View\ViewModel\MultipleObjectItemViewModelInterface;
use Symfony\Component\Serializer\Attribute\Groups;

final class MultipleUserItemViewModel implements MultipleObjectItemViewModelInterface
{
    #[Groups('admin', 'member')]
    public int $id;
    public string $username;
    #[Groups('admin', 'member')]
    public string $email;
    #[Groups('admin', 'member')]
    public string $type;
    #[Groups('admin', 'member')]
    public string $status;
}