<?php


namespace Platform\Listeners;


use Platform\Authentication\CustomerWasCreated;
use Platform\Events\EventListener;
use Platform\Mailer\Mailer;

class EmailNotifier extends EventListener{

    protected $mailer;

    function __construct (Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    public function whenCustomerWasCreated(CustomerWasCreated $event)
    {
        $this->mailer->sendTo($event, "Welcome to Sourceeasy","emails.users.welcome",[]);
    }
}