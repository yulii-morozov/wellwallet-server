<?php

namespace App\Enums;

enum OrderStatus: string
{
    case CREATED = 'created';
    case IN_PROGRESS = 'in_progress';
    case CLOSED = 'closed';
}