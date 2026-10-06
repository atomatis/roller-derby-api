<?php

declare(strict_types=1);

namespace App\Enum;

/** @author Alexandre Tomatis <alexandre.tomatis@gmail.com> */
enum ClubGenderDiversityPolicy: string
{
    case ChosenNonMixity = 'CNM';
    case Mixed = 'MIX';
}
