<?php
namespace App\Helpers;

use App\Models\Admin\Email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class MailHelper{

    public static function mailable(){
        $email=Email::first();
        if(!$email){
            return false;
        }
        $config=[
            'transport'=>'smtp',
            'host'=>$email->mail_host,
            'username'=>$email->smtp_user_name,
            'password'=>$email->smtp_password,
            'port'=>(int)$email->smtp_port,
            'encryption'=>$email->mail_encryption,
            'timeout'=>null
        ];
        config(['mail.mailers.smtp' => $config]);
        config(['mail.from.address' => $email->from_address ?? 'noreply@example.com']);
        config(['mail.from.name' => $email->from_name ?? 'App']);

        Mail::purge('smtp');
        return true;
    }
}

?>

