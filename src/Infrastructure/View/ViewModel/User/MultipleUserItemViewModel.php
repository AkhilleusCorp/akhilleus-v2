<?php

namespace App\Infrastructure\View\ViewModel\User;

use App\Infrastructure\View\ViewModel\MultipleObjectItemViewModelInterface;

final class MultipleUserItemViewModel implements MultipleObjectItemViewModelInterface
{
    public int $id;
    public string $username;
    public string $email;
    public string $type;
}