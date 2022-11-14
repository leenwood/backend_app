<?php

namespace App\Service\UserService\DTO;

use App\Entity\User;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserListResponse
{
    /** @var int */
    private int $countPage;

    /** @var int  */
    private int $currentPage;

    /** @var array<UserResponse> */
    private array $userList;


    /**
     * @param array<User> $userList
     * @throws UnknownProperties
     */
    public function __construct(
        int $countPage,
        int $currentPage,
        array $userList
    )
    {
        $this->countPage = $countPage;
        $this->currentPage = $currentPage;
        foreach ($userList as $user) {
            $this->userList[] = new UserResponse([
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'userIdentifier' => $user->getUserIdentifier(),
                    'roles' => $user->getRoles()
                ]);
        }
    }

    /**
     * @return int
     */
    public function getCountPage(): int
    {
        return $this->countPage;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @return array<UserResponse>
     */
    public function getUserList(): array
    {
        return $this->userList;
    }
}