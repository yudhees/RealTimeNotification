<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('form-notifications.{userId}', function (User $user, $userId) {
    return $user->id==$userId;
});
