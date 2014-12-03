<?php
/**
 * Created by PhpStorm.
 * User: chiragchamoli
 * Date: 19/06/14
 * Time: 12:26 AM
 */

namespace Platform\Authentication;

use Platform\Events\EventGenerator;
use Platform\Events\EventDispatcher;
use Platform\Repositories\UserRepository;
use Platform\Commands\CommandHandler;

class LoginCommandHandler implements CommandHandler{

    use EventGenerator;
    protected $userRepo;
    protected $dispatcher;

    function __construct(UserRepository $userRepo, EventDispatcher $dispatcher)
    {
        $this->userRepo = $userRepo;
        $this->dispatcher =  $dispatcher;
    }

    public function handle($command)
    {
        $response = $this->userRepo->login($command);
        if($response['status'] == false)
        {
            throw new \Exception($response['message']);
        }
        $this->userRepo->updateLastLogin();
        //dd($this->userRepo->login($command));
        //$this->raise(new CustomerWasLoggedIn($user));
        //$this->dispatcher->dispatch($this->releaseEvents());
        //return true;
    }
}