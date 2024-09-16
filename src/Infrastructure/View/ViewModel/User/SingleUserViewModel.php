<?php

namespace App\Infrastructure\View\ViewModel\User;

use App\Infrastructure\View\ViewModel\SingleObjectViewModelInterface;

final class SingleUserViewModel implements SingleObjectViewModelInterface
{
    public int $id;

    public string $login;

    public string $email;
}