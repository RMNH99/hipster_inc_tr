<?php

namespace App\Services;

use App\Models\Presences;

class PresenceService
{
 
    public static function updatePresence($user, $status)
    {
        Presences::updateOrCreate(
            [
                'user_type' => get_class($user),
                'user_id' => $user->id,
            ],
            [
                'is_online' => $status,
                'last_seen' => now(),
            ]
        );
    }
}
