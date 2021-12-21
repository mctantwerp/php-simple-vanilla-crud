<?php

function getActive(string $menu, string $page='home'): string
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
