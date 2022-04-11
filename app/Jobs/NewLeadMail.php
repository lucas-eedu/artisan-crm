<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewLeadMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Attempted amount to be performed
     *
     * @var int
     */
    public $tries = 3;

    /**
     * Users who will receive the new lead notification email
     *
     * @var mixed
     */
    private $users;
    
    /**
     * Lead that was created
     *
     * @var mixed
     */
    private $lead;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, $lead)
    {
        $this->users = $users;
        $this->lead = $lead;
        self::onQueue('sendNewLeadMail');
    }

    /**
     * Triggers email to all users who should receive new lead notice
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->users as $user) {
            Mail::to($user->email)->send(new \App\Mail\NewLeadMail($this->lead));
        }
    }
}
