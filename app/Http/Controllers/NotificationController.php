<?php

namespace App\Http\Controllers;

use App\Events\NotifyTest;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Pusher\Pusher;

class NotificationController extends Controller
{
    public function notify()
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data['message'] = 'hello investmentnovel';
        $pusher->trigger('notify-channel', 'App\\Events\\NotifyTest', $data);

    }

}
