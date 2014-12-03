<?php


/*
* app/validators.php
*/

Validator::extend('alpha_spaces', function($attribute, $value)
{
    return preg_match('/^([-a-z0-9_-\s])+$/i', $value);
});

Validator::extend('alpha_dot', function($attribute, $value)
{
    return preg_match('/^([-a-z0-9\._-\s])+$/i', $value);
});