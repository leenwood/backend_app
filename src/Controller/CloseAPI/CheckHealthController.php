<?php

namespace App\Controller\CloseAPI;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[Rest\Route('/api')]
class CheckHealthController extends AbstractFOSRestController
{

    #[Rest\Get('/user/check/me', name: 'check_health_user_self')]
    public function getUserInfo(
        TokenStorageInterface $tokenStorage
    ): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        return $this->handleView($this->view($user));
    }

}