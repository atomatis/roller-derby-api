<?php

namespace App\Action\Admin\Club;

use App\Entity\Club;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ViewAction extends AbstractController
{
    const string ROUTE_NAME = 'admin_club_view';

    #[Route('/admin/clubs/{id}', name: self::ROUTE_NAME)]
    public function view(Club $club): Response
    {
        return $this->render('admin/club/view.html.twig', [
            'club' => $club,
        ]);
    }
}
