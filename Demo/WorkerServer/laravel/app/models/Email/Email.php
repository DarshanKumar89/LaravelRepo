<?php

class Email extends Eloquent
{

    public function sendEmail($from,$to,$cc = Null,$bcc = Null,$subject,$text = Null,$html = Null,$attachmentList = Null,$inlineImage = Null)
    {
              Mail::queue('emails', array(), function($message)
               {
			    $message->from($from);

			    $message->to($to)->cc($cc);

			    $message->subject($subject);

			    $message->attach($attachmentList);
                });

    }

}
