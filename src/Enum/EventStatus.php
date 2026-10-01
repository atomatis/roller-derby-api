<?php

namespace App\Enum;

enum EventStatus: string
{
    case SEARCHING = 'searching';
    case VALIDATED = 'validated';
    case IN_PROGRESS = 'in-progress';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
}
