<?php

namespace Platform\Authentication;

Use User;

class CustomerWasCreated {

    public $user;

    /**
     * @param User $user
     */
    function __construct(User $user)
    {
        $this->user = $user;
    }


}