<?php
use App\Models\Order;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('orders.{customerId}', function ($user, $customerId) {
    return true;
});

Broadcast::channel('presence-users', function ($user) {
    return [
        'id' => $user->id,
        'name' => $user->name,
        'type' => $user instanceof Admin ? 'admin' : 'customer',
    ];
});