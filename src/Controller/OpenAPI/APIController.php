<?php

namespace App\Controller\OpenAPI;

use App\Repository\UserRepository;
use App\Service\UserService\ControlUserService;
use DateTime;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class APIController extends AbstractFOSRestController
{
    public function __construct(
        private ControlUserService $controlUserService,
        private UserRepository $userRepository
    )
    {
    }

    #[Rest\Get('/users', name: 'user_list_app')]
    public function getListUser(): Response
    {
        try {
            $view = $this->view($this->controlUserService->getUserList());
        } catch (\Throwable $e) {
            dd($e);
        }
        return $this->handleView($view);
    }

    #[Rest\Get('/test/{id}', name: 'test')]
    public function test(int $id): Response
    {
        $user = $this->userRepository->findOneBy(['id' => $id]);
//        $user->setName("Георгий");
//        $user->setWorkAddress('Россия, Свердловская область, город Екатеринбург, Октябрьский район, Малышева 71');
//        $user->setDescription("
//        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
//        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
//        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
//        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
//        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
//        and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
//        ");
//
//        $this->userRepository->save($user, true);
//        $user->setCityLiving('Россия, Свердловская область, город Екатеринбург');
//        $user->setSurname('Ершов');
//        $user->setAge(21);
//        $user->setDateOfBirth(new DateTime('now'));
//        $this->userRepository->save($user, true);
        dd($user);
        return $this->handleView($this->view(['test1', 'test2'], 200));
    }

}