<?php

namespace Platform\Templates;
use Platform\Commands\CommandHandler;

class CreateTemplateCommandHandler implements CommandHandler
{

    /**
     * @param $command
     * @return mixed
     */
    public function handle ($command)
    {
        dd($command);
        // TODO: Implement handle() method.
    }
}