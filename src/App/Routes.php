<?php

declare(strict_types=1);

namespace App\App;

use App\Action\Api\SearchAction;
use App\Action\Club;
use App\Action\Event;
use App\Action\Page\AboutAction;
use App\Action\Page\CguAction;
use App\Action\Page\ContactAction;
use App\Action\Page\FlattrackRankingAction;
use App\Action\Page\LegalAction;
use App\Action\Page\UpgradeLogsAction;
use App\Action\Team;

/** @author Alexandre Tomatis <alexandre.tomatis@gmail.com> */
final readonly class Routes
{
    public static function getRoutes(): array
     {
        return [
            'club' => [
                'view' => \App\Action\Interleague\Club\ViewAction::ROUTE_NAME,
                'list' => \App\Action\Interleague\Club\ListAction::ROUTE_NAME,
                'edit' => \App\Action\Interleague\Club\EditAction::ROUTE_NAME,
                'create' => \App\Action\Interleague\Club\CreateAction::ROUTE_NAME,
            ],
            'team' => [
                'view' => \App\Action\Interleague\Team\ViewAction::ROUTE_NAME,
                'list' => \App\Action\Interleague\Team\ListAction::ROUTE_NAME,
                'edit' => \App\Action\Admin\Team\EditAction::ROUTE_NAME,
                'create' => \App\Action\Admin\Team\CreateAction::ROUTE_NAME,
            ],
            'game' => [ // TODO
                'view' => \App\Action\Interleague\Team\ViewAction::ROUTE_NAME,
            ],
            'event' => [ // TODO
                'view' => \App\Action\Interleague\Event\ViewAction::ROUTE_NAME,
//                'list' => Event\ListAction::ROUTE_NAME,
                'edit' => Event\EditAction::ROUTE_NAME,
                'create' => Event\CreateAction::ROUTE_NAME,
            ],
            'championship' => [ // TODO
                'view' => \App\Action\Interleague\Team\ViewAction::ROUTE_NAME,
                'list' => \App\Action\Interleague\Team\ListAction::ROUTE_NAME,
                'edit' => \App\Action\Admin\Team\EditAction::ROUTE_NAME,
                'create' => \App\Action\Admin\Team\CreateAction::ROUTE_NAME,
            ],
            'page' => [
                'home' => Event::ROUTE_NAME,
                'flattrackRanking' => FlattrackRankingAction::ROUTE_NAME,
                'about' => AboutAction::ROUTE_NAME,
                'contact' => ContactAction::ROUTE_NAME,
                'cgu' => CguAction::ROUTE_NAME,
                'upgradeLogs' => UpgradeLogsAction::ROUTE_NAME,
            ],
            'widget' => [
                'search' => SearchAction::ROUTE_NAME,
            ],
        ];
     }
}
