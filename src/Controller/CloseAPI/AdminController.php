<?php

namespace App\Controller\CloseAPI;

use App\Service\UserService\ControlUserService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

#[Rest\Route('/api')]
class AdminController extends AbstractFOSRestController
{
    /**
     * @param ControlUserService $controlUserService
     */
    public function __construct(
        private ControlUserService $controlUserService
    )
    {
    }

    #[Rest\Get('/admin/users', name: 'user_list_app')]
    public function getListUser(): Response
    {
        try {
            $view = $this->view($this->controlUserService->getUserList());
        } catch (\Throwable $e) {
            dd($e);
        }
        return $this->handleView($view);
    }
}