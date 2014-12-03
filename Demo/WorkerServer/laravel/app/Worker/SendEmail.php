<?php

class SendEmail {
  
  		public function fire($job, $data)
  		{
  			//
$mailuserlist=DB::table('users')
        ->select('email')
        ->where('id'))->get();

foreach ($mailuserlist as $mailuser) {
    Mail::queue('mail_template', $data, function($message) use ($mailuser) {
        $message
          ->from('test@sourceeasy.com', 'Mail Notification')
          ->to($mailuser['email'])
          ->subject('Testing mail');
    });



  		}

  		$job->delete();
  
  	}
  }