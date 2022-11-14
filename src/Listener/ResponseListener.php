<?php

// namespace App\Listener;

// use Symfony\Component\EventDispatcher\EventSubscriberInterface;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\HttpKernel\Event\ResponseEvent;
// use Symfony\Component\HttpKernel\KernelEvents;

// class ResponseListener implements EventSubscriberInterface
// {

//     public function onKernelResponse( ResponseEvent $event )
//     {
//         $response = $event->getResponse();
//         $response->headers->set('Access-Control-Allow-Origin', '*');
//         return ;
//     }

//     public static function getSubscribedEvents()
//     {
//         return array(
//             KernelEvents::RESPONSE => array( 'onKernelResponse', 0 ),
//         );
//     }
// }