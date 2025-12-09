<?php

namespace App\Enums;

enum AttendanceStatusEnum: string
{
    case PRESENT = 'present';
    case ABSENT = 'absent';
    case LATE = 'late';
    case EARLY_LEAVE = 'early_leave';
    case HALF_DAY = 'half_day';
    case LEAVE = 'leave';
    case HOLIDAY = 'holiday';
    case WEEK_OFF = 'week_off';
}
