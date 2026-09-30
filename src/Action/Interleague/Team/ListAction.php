<?php

namespace App\Action\Interleague\Team;

use App\Dto\TeamByLevelDto;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ListAction extends AbstractController
{
    const string ROUTE_NAME = 'interleague_team_list';
    private const string QUERY_PARAM_FILTERS_BY = 'by';
    const string QUERY_PARAM_FILTERS_CATEGORY = 'category';
    private const string QUERY_PARAM_FILTERS_TYPE = 'type';
    private const string QUERY_PARAM_FILTERS_LEVEL = 'level';
    private const string QUERY_PARAM_FILTERS_ACTIVITY = 'activity';
    private const string FILTERS_SHOW_CLOSED_DISBAND_ACTIVE = 'active';
    private const string FILTERS_SHOW_CLOSED_DISBAND_INACTIVE = 'inactive';
    private const string FILTERS_SHOW_CLOSED_DISBAND_BOTH = 'both';

    public function __construct(
        private readonly TeamRepository $teamRepository,
    ){}

    #[Route('/interleague/teams', name: self::ROUTE_NAME)]
    public function list(Request $request): Response
    {
        $criteria = new Criteria();
        $criteria->orderBy(["name" => "ASC"]);
        $criteria->where(Criteria::expr()->eq('countryCode', 'FRA'));
        $this->bindFilterByCriteria($request, $criteria);
        // $this->bindOrderByCriteria($request, $criteria);

        $teams = $this->teamRepository->matching($criteria);

//        $filters = $request->query->get('filters') ?? [];
//        if (array_key_exists(self::QUERY_PARAM_FILTERS_BY, $filters)) {
//            $filters[self::QUERY_PARAM_FILTERS_BY]
//        }

        $teams = TeamByLevelDto::fromEntities($teams);

        return $this->render('interleague/team/list.html.twig', [
            'teamContainer' => $teams,
            'filters' => ['filters[category]' => 'M']
        ]);
    }

    private function bindFilterByCriteria(Request $request, Criteria $criteria): void
    {
        $filters = $request->query->filter(key:'filters', default:[], options:['flags' => \FILTER_REQUIRE_ARRAY]);

       if (array_key_exists(self::QUERY_PARAM_FILTERS_CATEGORY, $filters)) {
           if (!is_array($filters[self::QUERY_PARAM_FILTERS_CATEGORY])) {
               $filters[self::QUERY_PARAM_FILTERS_CATEGORY] = [$filters[self::QUERY_PARAM_FILTERS_CATEGORY]];
           }

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
