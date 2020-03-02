<?php

namespace App\Providers;

use App\Observers\PostObserver;
use App\Post;
use Illuminate\Support\ServiceProvider;
use Pusher\PushNotifications\PushNotifications;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Post::observe(PostObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(PushNotifications::class, function () {
            $config = config('broadcasting.connections.pusher.beams');

            return new PushNotifications([
                'secretKey' => $config['secret_key'] ?? '',
                'instanceId' => $config['instance_id'] ?? '',
            ]);
        });
    }
}
