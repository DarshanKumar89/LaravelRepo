<?php

namespace Platform\Authentication;

use Platform\Events\EventGenerator;
use Platform\Events\EventDispatcher;
use Platform\Repositories\UserRepository;
use Platform\Commands\CommandHandler;


class CreateCustomerCommandHandler implements CommandHandler{

    use EventGenerator;
    protected $userRepo;
    protected $dispatcher;

   function __construct(UserRepository $userRepo, EventDispatcher $dispatcher)
    {
        $this->userRepo = $userRepo;
        $this->dispatcher =  $dispatcher;
    }
    /**
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $user = $this->userRepo->createCustomer($command);
        $this->raise(new CustomerWasCreated($user));
        $this->dispatcher->dispatch($this->releaseEvents());
        return true;
    }
}