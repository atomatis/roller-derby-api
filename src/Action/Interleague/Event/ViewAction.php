<?php

namespace App\Action\Interleague\Event;

use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewAction extends AbstractController
{
    const string ROUTE_NAME = 'event_view';
    #[Route('/events/{id}', name: self::ROUTE_NAME)]
    public function view(Event $event): Response
    {
        return $this->render('event/view.html.twig', [
            'event' => $event,
        ]);
    }
}
