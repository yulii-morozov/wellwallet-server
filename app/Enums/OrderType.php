<?php

namespace App\Enums;

enum OrderType: string
{
    case PURCHASE = 'purchase';
    case SALE = 'sale';
}