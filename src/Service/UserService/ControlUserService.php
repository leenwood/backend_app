<?php

namespace App\Service\UserService;

use App\Repository\UserRepository;
use App\Service\UserService\DTO\UserListResponse;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use function Sodium\add;

class ControlUserService
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    /**
     * @throws UnknownProperties
     */
    public function getUserList(int $page = 1): UserListResponse {
        $countPage = ceil($this->userRepository->getCountPage()/25);
        $userList = $this->userRepository->findAll();
        return new UserListResponse($countPage, $page, $userList);
    }

}