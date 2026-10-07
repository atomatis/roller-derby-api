<?php

declare(strict_types=1);

namespace App\Enum;

/** @author Alexandre Tomatis <alexandre.tomatis@gmail.com> */
enum TeamCategory: string
{
    case WomenAndGenderMinorities = 'F+';
    case Open = 'O';
    case JuniorWomenAndGenderMinorities = 'JF+';
    case JuniorOpen = 'JO';

    private const array map = [
        self::WomenAndGenderMinorities->value => 'F+',
        self::Open->value => 'Open',
        self::JuniorOpen->value => 'Junior',
    ];

    static function getName(string $category): string
    {
        return self::map[$category];
    }
}
