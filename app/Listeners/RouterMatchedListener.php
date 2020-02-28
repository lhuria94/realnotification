<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Listeners;

use Cache;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;

class RouterMatchedListener
{
    /**
     * Handle the event.
     *
     * @param  router.matched  $event
     * @return void
     */
    public function handle()
    {
//      //app('App\Http\Controllers\UsersController')->notifications();
//      \Illuminate\Support\Facades\Log::info("In");
//      event(new App\Events\StatusLiked('Guest'));
      \Illuminate\Support\Facades\Log::info("RouterMatchedListener");
      
    }
}