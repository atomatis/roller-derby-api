<?php

declare(strict_types=1);

namespace App\Action;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/** @author Alexandre Tomatis <alexandre.tomatis@gmail.com> */
final class TestAction extends AbstractController
{
    const string ROUTE_NAME = 'integration_sheet';

    #[Route('/integrationSheet', name: self::ROUTE_NAME)]
    public function search(): Response
    {
        return $this->render('integration_sheet.html.twig');
    }
}
