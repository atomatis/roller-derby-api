<?php

namespace App\Action\Interleague\Club;

use App\Entity\Club as ClubEntity;
use App\Model\Interleague\Club;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewAction extends AbstractController
{
    const string ROUTE_NAME = 'interleague_club_view';
    #[Route('/interleague/clubs/{id}', name: self::ROUTE_NAME)]
    public function view(ClubEntity $club): Response
    {
        return $this->render('interleague/club/view.html.twig', [
            'club' => Club::fromEntity($club),
        ]);
    }
}
