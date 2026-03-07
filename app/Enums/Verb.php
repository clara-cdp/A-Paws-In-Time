<?php

namespace App\Enums;

enum Verb: string
{
    case LOOK_AT = 'LOOK AT';
    case USE = 'USE';
    case PICK_UP = 'PICK UP';
    case GIVE = 'GIVE';
    case OPEN = 'OPEN';
    case CLOSE = 'CLOSE';
    case PULL = 'PULL';
    case PUSH = 'PUSH';
}