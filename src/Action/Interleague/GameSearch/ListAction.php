<?php

namespace App\Action\Interleague\GameSearch;

use App\Repository\EventSearchCriteriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListAction extends AbstractController
{
    const string ROUTE_NAME = 'game_search_list';

    public function __construct(
        private readonly EventSearchCriteriaRepository $eventSearchCriteriaRepository,
    ){}

    #[Route('/interleague/gameSearchs', name: self::ROUTE_NAME)]
    public function list(Request $request): Response
    {
        return $this->render('interleague/game_search/list.html.twig', [
            'eventSearchCriteria' => $this->eventSearchCriteriaRepository->findAll(),
        ]);
    }
}
