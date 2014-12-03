<?php
namespace Platform\Mailer;

use \Mail;

class Mailer
{

    /**
     * @param $user
     * @param $subject
     * @param $view
     * @param $data
     */
    public function sendTo($user, $subject, $view, $data)
    {
        $email = $user->user->email;
        $full_name = $user->user->first_name." ".$user->user->last_name;

        Mail::send($view,$data, function($message) use($email, $full_name, $subject )
        {
            $message->to($email, $full_name)->subject($subject);
        });

    }
}