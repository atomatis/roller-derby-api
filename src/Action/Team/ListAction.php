<?php

namespace App\Action\Team;

use App\Dto\TeamByAlphaDto;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class ListAction extends AbstractController
{
    const string ROUTE_NAME = 'team_list';
    private const string QUERY_PARAM_FILTERS_CATEGORY = 'category';
    private const string QUERY_PARAM_FILTERS_TYPE = 'type';
    private const string QUERY_PARAM_FILTERS_LEVEL = 'level';
    private const string QUERY_PARAM_FILTERS_ACTIVITY = 'activity';
    private const string FILTERS_SHOW_CLOSED_DISBAND_ACTIVE = 'active';
    private const string FILTERS_SHOW_CLOSED_DISBAND_INACTIVE = 'inactive';
    private const string FILTERS_SHOW_CLOSED_DISBAND_BOTH = 'both';

    public function __construct(
        private readonly TeamRepository $teamRepository,
        private readonly SerializerInterface $serializer,
    ){}

    #[Route('/teams', name: self::ROUTE_NAME)]
    public function list(Request $request): JsonResponse
    {
        $criteria = new Criteria();
        $criteria->orderBy(["name" => "ASC"]);
        $criteria->where(Criteria::expr()->eq('countryCode', 'FRA'));
        $this->bindFilterByCriteria($request, $criteria);
        // $this->bindOrderByCriteria($request, $criteria);

        $teams = $this->teamRepository->matching($criteria);

        $teams = TeamByAlphaDto::fromEntities($teams);
        $jsonResponse = $this->serializer->serialize($teams, 'json');

        return new JsonResponse($jsonResponse, Response::HTTP_OK, [], true);
    }

    private function bindFilterByCriteria(Request $request, Criteria $criteria): void
    {
        $filters = $request->query->get('filters') ?? [];

       if (array_key_exists(self::QUERY_PARAM_FILTERS_CATEGORY, $filters)) {
           $criteria->andWhere(Criteria::expr()->in('category', $filters[self::QUERY_PARAM_FILTERS_CATEGORY]));
       }

       if (array_key_exists(self::QUERY_PARAM_FILTERS_TYPE, $filters)) {
           $criteria->andWhere(Criteria::expr()->in('type', $filters[self::QUERY_PARAM_FILTERS_TYPE]));
       }

       if (array_key_exists(self::QUERY_PARAM_FILTERS_LEVEL, $filters)) {
           $criteria->andWhere(Criteria::expr()->in('level', $filters[self::QUERY_PARAM_FILTERS_LEVEL]));
       }

       switch ($filters[self::QUERY_PARAM_FILTERS_ACTIVITY] ?? null) {
           // case self::FILTERS_SHOW_CLOSED_DISBAND_ACTIVE:
           case self::FILTERS_SHOW_CLOSED_DISBAND_INACTIVE:
               $criteria->andWhere(Criteria::expr()->isNotNull('disbandAt'));break;
           case self::FILTERS_SHOW_CLOSED_DISBAND_BOTH:break;
           default:
               $criteria->andWhere(Criteria::expr()->eq('disbandAt', null));break;
       }
    }
}
