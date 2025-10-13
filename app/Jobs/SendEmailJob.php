<?php

namespace App\Jobs;

use App\Models\User;
use App\Helpers\MailHelper;
use Illuminate\Bus\Queueable;
use App\Mail\ResetPasswordMail;
use App\Models\Admin\EmailTemplate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $email;
    private $userId;

    /**
     * Create a new job instance.
     */
    public function __construct(string $email, int $userId)
    {
        $this->email = $email;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user=User::find($this->userId);
        MailHelper::mailable();
        try{

            $reset_link=route('user.reset.password').'?token='.$user->forget_password_token.'&email='.$user->email;
            $link = "<a target='_blank' href='{$reset_link}'>{$reset_link}</a>";

            $template=EmailTemplate::where('name','Reset Password')->first();
            $subject=$template->subject;
            $message= $template->description;
            $message = str_replace('{{user_name}}',$user->name,$message);
            $message = str_replace('{{verification_link}}',$link,$message);

            // SendEmailJob::dispatch($user->email, $user->id);

            Mail::to($user->email)->send(new ResetPasswordMail($user,$message,$subject));

        }catch(\Exception $e){
            Log::info('Error:'.$e->getMessage());

        }
    }
}
