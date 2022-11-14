<?php

namespace App\Service\UserService\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class UserResponse extends DataTransferObject
{
    public ?int $id;

    public string $username;

    public string $userIdentifier;

    public array $roles;
}