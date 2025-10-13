<?php

namespace App\Jobs;


use App\Models\User;
use App\Helpers\MailHelper;
use App\Mail\OfferSendMail;
use App\Models\Admin\EmailTemplate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class OfferMailJobForAdmin implements ShouldQueue
{
     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userId;
    private $email;

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
        MailHelper::mailable();
        $user=User::find($this->userId);

        try{

            $emailTemplate=EmailTemplate::where('name','Offer Messages')->first();
            $subject=$emailTemplate->subject;
            $messages=$emailTemplate->description;
            $link='<a href="'.route('home').'" target="_blank">Visit Here</a>';
            $attachmentPath = public_path($user->photo);
            $attachment = $user->photo ? '<img src="' . asset($user->photo) . '" alt="User Image" width="100" height="100">' : '';
            $messages=str_replace('{{offer_link}}', $link, $messages);

            $messages=str_replace('{{user_name}}', $user->name, $messages);

            $messages=str_replace('{{image}}', $attachment, $messages);

            // Send email
            Mail::to($this->email)->send(new OfferSendMail($user,$messages,$subject,$attachmentPath));

        }catch(\Exception $e){
            Log::info('Error:'.$e->getMessage());
        }
    }
}
