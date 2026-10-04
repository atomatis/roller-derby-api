<?php

namespace App\Action\Interleague\Event;

use App\Repository\EventRepository;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListAction extends AbstractController
{
    const string ROUTE_NAME = 'event_list';

    public function __construct(
        private readonly EventRepository $eventRepository,
    ){}

    #[Route('/', name: self::ROUTE_NAME)]
    public function list(Request $request): Response
    {
        return $this->render('interleague/event/list.html.twig', [
            'events' => $this->eventRepository->findAll(),
        ]);
    }
}
