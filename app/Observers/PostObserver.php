<?php
namespace App\Observers;

use App\Notifications\NewPost;
use App\Post;

class PostObserver
{

    /**
     * Called whenever a post is created
     * @param Post $post
     */
    public function created(Post $post)
    {
        $user = $post->user;
        foreach ($user->followers as $follower) {
          \Illuminate\Support\Facades\Log::info("---Here PostObserver Added----------");
            $follower->notify(new NewPost($user, $post));
        }
    }
    
    public function deleting(Post $post) {
      \Illuminate\Support\Facades\Log::info("---Here PostObserver Deleted----------");
        $user = $post->user;
        $user->notify(new NewPost($user, $post));
    }
}