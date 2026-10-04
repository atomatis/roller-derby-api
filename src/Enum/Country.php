<?php

namespace App\Enum;

/**
 * Country code from ISO 3166-1 (https://en.wikipedia.org/wiki/ISO_3166-1)
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
enum Country: string
{
    case UNKNOWN = 'UNK';
    case FRANCE = 'FRA';
    case WORLD = 'WOR';
    case SOUTH_AFRICA = 'ZAF';
    case BELGIUM = 'BEL';
    case SPAIN = 'ESP';
    case ITALY = 'ITA';
    case GERMANY = 'DEU';
    case UNITED_KINGDOM = 'GBR';
    case NETHERLANDS = 'NLD';
    case ARGENTINA = 'ARG';
    case DENMARK = 'DNK';
    case IRELAND = 'IRL';
    case SWITZERLAND = 'CHE';
    case SWEDEN = 'SWE';
    case PUERTO_RICO = 'PRI';
    case NORWAY = 'NOR';
    case PORTUGAL = 'PRT';
    case FINLAND = 'FIN';
    case AUSTRIA = 'AUT';
    case MEXICO = 'MEX';
    case CZECH_REPUBLIC = 'CZE';
    case NEW_ZEALAND = 'NZL';
    case CANADA = 'CAN';
    case USA = 'USA';
}
