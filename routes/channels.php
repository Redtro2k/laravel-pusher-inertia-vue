<?php

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

Broadcast::channel('wep-app', function(){
    return true;
});

// the name your channel on that you created from pusher
//rename your env like this

// BROADCAST_DRIVER=pusherxx
// PUSHER_APP_ID=1557xxx
// PUSHER_APP_KEY=196253550631eexxx
// PUSHER_APP_SECRET=3533016ee20f95ecxxx
// PUSHER_HOST=
// PUSHER_PORT=443
// PUSHER_SCHEME=https
// PUSHER_APP_CLUSTER=ap1
