<?php

namespace App\Service\UserService;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UserService\DTO\UserListResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use function Sodium\add;

class ControlUserService
{
    /**
     * @param UserRepository $userRepository
     * @param UserPasswordHasherInterface $passwordEncoder
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        private UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordEncoder,
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    /**
     * @param int $page
     *
     * @return UserListResponse
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     * @throws UnknownProperties
     */
    public function getUserList(int $page = 1): UserListResponse {
        $countPage = ceil($this->userRepository->getCountPage()/25);
        $userList = $this->userRepository->findAll();
        return new UserListResponse($countPage, $page, $userList);
    }

    public function createUser(string $name, string $password): void {
        $newUser = new User();
        $newUser->setUsername($name);
        $newUser->setRoles(['ROLE_USER']);
        $newUser->setPassword($this->passwordEncoder->hashPassword($newUser, $password));
        $this->entityManager->persist($newUser);
        $this->entityManager->flush();
    }

}