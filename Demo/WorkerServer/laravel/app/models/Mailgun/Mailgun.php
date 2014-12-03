<?php

use Mailgun\Mailgun;

class Mailgun extends Eloquent
{
	private $mailgun;
    private $config;

    public function __construct()
    {
        $this->config = \Config::get('mailgun');
    }

    public function sendEmail($from,$to,$cc = Null,$bcc = Null,$subject,$text = Null,$html = Null,$attachmentList = Null,$inlineImage = Null)
    {
    	$this->mailgun = new Mailgun($this->config['key']);
        
		try {
            $result = $this->mailgun->sendMessage(
			            $this->config['domain'],
			            array(
			                'from' => $from,
			                'to' => $to,
			                'cc' => $cc,
			                'bcc' => $bcc,
			                'subject' => $subject,
			                'text' => $text,
			                'html' => $html
			            ),
			            array('attachment' => $attachment),
			            array('inline' => $inlineImage)
			        );
        }
        catch(\Exception $e)
        {
            return $this->respondInternalError('Unable to send Email.');
        }

        return $result;
    }

}
