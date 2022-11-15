<?php

namespace App\Controller\OpenAPI;

use App\Service\UserService\ControlUserService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[Rest\Route('/user')]
class UserController extends AbstractFOSRestController
{
    /**
     * @param ControlUserService $controlUserService
     */
    public function __construct(
        private ControlUserService $controlUserService
    )
    {
    }


    #[Rest\Post('/register', name: 'register_new_user')]
    #[Rest\RequestParam(name: 'username', nullable: true)]
    #[Rest\RequestParam(name: 'password', nullable: true)]
    public function registerUser(
        ParamFetcherInterface $fetcher,
    ): Response
    {
        try {
            $this->controlUserService->createUser($fetcher->get('username'), $fetcher->get('password'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return $this->handleView($this->view(['False']));
        }

        return $this->handleView($this->view(['Success']));
    }
}