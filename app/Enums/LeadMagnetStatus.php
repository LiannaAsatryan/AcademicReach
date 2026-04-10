<?php

namespace App\Enums;

enum LeadMagnetStatus: string
{
    case Draft = 'draft';
    case Generated = 'generated';
    case Exported = 'exported';
}

