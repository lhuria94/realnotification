<?php

namespace App\Listeners;

    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use App\Events\StatusLiked;
    use Pusher\PushNotifications\PushNotifications;

class StatusLikedListener
{
use InteractsWithQueue;

        protected $beams;

        public function __construct(PushNotifications $pushNotifications)
        {
            $this->beams = $pushNotifications;
        }

        public function handle(StatusLiked $event)
        {
            $payload = [
                'title' => 'Document created',
                'body' => "A new document $event->message has been created by the assignee",
            ];

            // Interest: auth-janedoe-at-pushercom
            $interests = ['debug-aux'];

            $this->beams->publishToInterests($interests, [
                'apns' => [
                    'aps' => [
                        'alert' => $payload,
                        'category' => 'LoginActions',
                        'payload' => ['message' => $event->message ],
                    ],
                ],
            ]);
        }
}
