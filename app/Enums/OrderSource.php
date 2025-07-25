<?php

namespace App\Enums;

enum OrderSource: string
{
    case WEB = 'web';
    case TELEGRAM = 'telegram';
}