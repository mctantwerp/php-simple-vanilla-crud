<?php

function registerExceptionHandler(): void
{
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

function getActiveMenu(string $menu, string $page='home'): string
{
    // Als de huidige pagina overeenkomt met het huidige menu gaan we die active zetten
    if($page === $menu)
    {
        return ' active';
    }
    else
    {
        return '';
    }
}

function getCurrentDateTime(): string
{
    return date('Y-m-d H:i:s');
}

function flash($key, $value = null): mixed
{
    if(!empty($value))
    {
        $_SESSION[$key] = $value ?? '';
    }

    if(empty($value))
    {
        $value = $_SESSION[$key] ?? '';

        if(!empty($value))
        {
            unset($_SESSION[$key]);
        }
    }

    return $value;
}

function old($key, $var = null)
{
    $var = $var ?? 'form';
    $data = flash($var);

    return $data[$key] ?? null;
}

function redirect($url): void
{
    header('location: ' . $url);
    exit;
}
