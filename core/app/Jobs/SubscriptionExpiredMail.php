<?php

namespace App\Jobs;

use App\Http\Controllers\Controller;
use App\Models\BasicExtended;
use App\Models\BasicSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SubscriptionExpiredMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $controller = new Controller;

        $be = BasicExtended::first();
        $bs = BasicSetting::first();
        $subject = 'Your membership is expired';
        $name = $this->user->first_name;
        $body = "Hi " . $name . "<br>";
        $body .= "Your membership is expired.<br>";
        $body .= "Please <a href='" . route('user.login') . "'>Click Here</a> to log into the dashboard to purchase a new package / extend the current package to continue the membership.<br>";
        $body .= "Best Regards,<br>";
        $body .= $bs->website_title . ".";
        $email = $this->user->email;

        $controller->sendMailWithPhpMailer(NULL, NULL, $be, $subject, $body, $email, $name);
    }
}
