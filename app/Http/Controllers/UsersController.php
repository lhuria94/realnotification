<?php

namespace App\Http\Controllers;

use App\Notifications\UserFollowed;
use App\Events\StatusLiked as StatusLiked;
use App\User;
use Cache; 

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('users.index', compact('users'));
    }

    public function follow(User $user)
    {
        $follower = auth()->user();
        if ($follower->id == $user->id) {
            return back()->withError("You can't follow yourself");
        }
        if(!$follower->isFollowing($user->id)) {
            $follower->follow($user->id);

            // sending a notification
            $user->notify(new UserFollowed($follower));

            return back()->withSuccess("You are now friends with {$user->name}");
        }
        return back()->withError("You are already following {$user->name}");
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user();
        $message = 'My Chat Broadcast';
        //event(new \App\Events\AuthLoginEventHandler($user, $message));
        \Illuminate\Support\Facades\Log::info('---------Controller-----');
        broadcast(new \App\Events\AuthLoginEventHandler($user, $message))->toOthers();
        if($follower->isFollowing($user->id)) {
            $follower->unfollow($user->id);
            return back()->withSuccess("You are no longer friends with {$user->name}");
        }
        return back()->withError("You are not following {$user->name}");
    }

    public function notifications()
    {
      \Illuminate\Support\Facades\Log::info("---Here Added----------");
      \Illuminate\Support\Facades\Log::info("---ProductCategory----------".json_encode(auth()->user()->unreadNotifications()->limit(5)->get()->toArray()));
        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
    }
    
    public function sendNotification(){
      $current_msg = request()->route()->parameter('msg');
      event(new StatusLiked('Guest',$current_msg));
      return "Event has been sent!";
    }
}
