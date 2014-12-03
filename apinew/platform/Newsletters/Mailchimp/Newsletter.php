<?php

namespace Platform\Newsletters\Mailchimp;

use Platform\Newsletters\NewsletterList as NewsletterList;
use Mailchimp;

class Mail implements  NewsletterList{

    /**
     * @var
     */
    protected $mailchimp;
    protected $app_users_list = '816c9ae507';
    /**
     * @param Mailchimp $mailchimp
     */
    function __construct (Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }


    /**
     * Subscribe user to mailchip.
     * @param $list
     * @param $email
     * @return mixed
     */
    public function subscribeTo ($list, $email)
    {
        // TODO: Implement subscribeTo() method.
        return $this->mailchimp->lists->subscribe(
            $this->app_users_list,
            [ 'email' => $email ],
            null, // merge vars
            'html', // email type
            false, // double opt in
            true // update exiting user.
        );


    }

    /**
     * @param $list
     * @param $email
     * @return mixed
     */
    public function unsubscribeFrom ($list, $email)
    {
        // TODO: Implement unsubscribeFrom() method.
        return $this->mailchimp->lists->unsubscribe(
            $this->app_users_list,
            [ 'email' => $email ],
            false, // delete forever?
            false, // send goodbye?
            false // unsubscribe confirmation?
        );

    }
}