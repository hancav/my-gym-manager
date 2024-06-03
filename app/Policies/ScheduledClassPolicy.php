<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ScheduledClass;

class ScheduledClassPolicy
{
    public function delete(User $user, ScheduledClass $schedule)
    {
        return $user->id === $schedule->instructor_id;
    }
}
