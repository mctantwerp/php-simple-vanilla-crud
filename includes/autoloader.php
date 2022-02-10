<?php

// Hiermee zeg je dat vanaf een class wordt aangeroepen je deze gaat proberen in te laten zodat deze niet onnodig wordt ingeladen
spl_autoload_register('myAutoLoader');

function myAutoLoader($class)
{
    $parts = explode('\\', $class);
    include "classes/". end($parts) . '.php';
}
