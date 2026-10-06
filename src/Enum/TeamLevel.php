<?php

declare(strict_types=1);

namespace App\Enum;

/** @author Alexandre Tomatis <alexandre.tomatis@gmail.com> */
enum TeamLevel: string
{
    case Casual = 'CAS';
    case Rookie = 'ROO';
    case RankFour = 'RK4';
    case RankThree = 'RK3';
    case RankTwo = 'RK2';
    case RankOne = 'RK1';
}
