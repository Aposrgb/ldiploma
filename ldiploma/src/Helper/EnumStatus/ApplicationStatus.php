<?php
namespace App\Helper\EnumStatus;

enum ApplicationStatus: int
{
    case IN_PROCESS = 1;
    case APPROVED = 2;
}