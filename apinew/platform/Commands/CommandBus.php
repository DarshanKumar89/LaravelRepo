<?php
/**
 * Created by PhpStorm.
 * User: chiragchamoli
 * Date: 18/06/14
 * Time: 8:50 PM
 */
namespace Platform\Commands;

interface CommandBus
{

    public function execute ($command);
}