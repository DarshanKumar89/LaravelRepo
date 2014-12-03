<?php


namespace Platform\Commands;


/**
 * Interface CommandHandler
 * @package Platform\Commands
 */
interface CommandHandler{

    /**
     * @param $command
     * @return mixed
     */
    public function handle($command);

}