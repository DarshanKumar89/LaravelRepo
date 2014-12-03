<?php

namespace Platform\Newsletters;

use Illuminate\Support\ServiceProvider;

class NewsletterListServiceProvider extends ServiceProvider{


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register ()
    {
        // TODO: Implement register() method.
        $this->app->bind(
            'Platform\Newsletters\NewsletterList',
            'Platform\Newsletters\Mailchimp\NewsletterList'
        );

    }
}