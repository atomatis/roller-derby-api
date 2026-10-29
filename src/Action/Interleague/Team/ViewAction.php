<?php

namespace App\Action\Interleague\Team;

use App\App;
use App\Entity\Team;
use App\Repository\FlattrackRankingRepository;
use App\Scraper\Flattrack\EuropeanRankScraper;
use App\Scraper\Flattrack\Gender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

final class ViewAction extends AbstractController
{
    const string ROUTE_NAME = 'team_view';

    #[Route('/teams/{id}', name: self::ROUTE_NAME)]
    public function view(Team $team): Response
    {
        return $this->render('interleague/team/view.html.twig', [
            'team' => $team,
        ]);
    }
}
