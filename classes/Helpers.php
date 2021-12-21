<?php
class Helpers
{
    public static function getActive(string $page='home', string $menu): string
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
}
