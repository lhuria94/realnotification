<?php

namespace App\Console\Commands;


use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EventTrigger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:trigger';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Trigger Notification Event via browser';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $current_msg = 'Triggered Event';
    	//event(new App\Events\StatusLiked('Guest',$current_msg));
		$words = [
            'aberration' => 'a state or condition markedly different from the norm',
            'convivial' => 'occupied with or fond of the pleasures of good company',
            'diaphanous' => 'so thin as to transmit light',
            'elegy' => 'a mournful poem; a lament for the dead',
            'ostensible' => 'appearing as such but not necessarily so'
        ];
         
        // Finding a random word
        $key = array_rand($words);
        $value = $words[$key];
		$users = User::all();
        foreach ($users as $user) {
            Mail::raw("Scheduler Working Now -> {$current_msg}", function ($mail) use ($user) {
                $mail->from('shailendra.yadava@srijan.net');
                $mail->to($user->email)
                    ->subject('Triggered Event');
            });
        }

		$this->info('Event has been sent!');
    }
}
