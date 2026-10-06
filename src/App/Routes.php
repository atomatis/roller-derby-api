<?php

declare(strict_types=1);

namespace App\App;

use App\Action\Api\SearchAction;
use App\Action\Interleague\Event\ListAction;
use App\Action\Page\AboutAction;
use App\Action\Page\CguAction;
use App\Action\Page\ContactAction;
use App\Action\Page\UpgradeLogsAction;

/** @author Alexandre Tomatis <alexandre.tomatis@gmail.com> */
final readonly class Routes
{
    public static function getRoutes(): array
     {
        return [
            'club' => [
                'view' => \App\Action\Interleague\Club\ViewAction::ROUTE_NAME,
                'list' => \App\Action\Interleague\Club\ListAction::ROUTE_NAME,
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
                'list' => ListAction::ROUTE_NAME,
            ],
            'championship' => [ // TODO
                'view' => \App\Action\Interleague\Team\ViewAction::ROUTE_NAME,
                'list' => \App\Action\Interleague\Team\ListAction::ROUTE_NAME,
                'edit' => \App\Action\Admin\Team\EditAction::ROUTE_NAME,
                'create' => \App\Action\Admin\Team\CreateAction::ROUTE_NAME,
            ],
            'page' => [
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
