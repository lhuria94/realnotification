<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Post;
use App\User;

class NewPost extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var User
     */
    protected $following;

    /**
     * @var Post
     */
    protected $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $following, Post $post)
    {
        $this->following = $following;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
      \Illuminate\Support\Facades\Log::info("---Here New Post to Via Added----------");
        return ['database', 'broadcast'];
    }


    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
      \Illuminate\Support\Facades\Log::info("---Here New Post to Database Added----------");
        return [
            'following_id' => $this->following->id,
            'following_name' => $this->following->name,
            'post_id' => $this->post->id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
      \Illuminate\Support\Facades\Log::info("---Here New Post to Array Added----------");
        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'following_id' => $this->following->id,
                'following_name' => $this->following->name,
                'post_id' => $this->post->id,
            ],
        ];
    }
    
//    public function toBroadcast($notifiable)
//    {
//        return new BroadcastMessage([
//            'message' => 'Added Newly',
//            'subject' => 'Added Newly Subject',
//        ]);
//    }
}
