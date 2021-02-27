<?php
    include('./classes/DB.php');
    include('./classes/Helpers.php');
    include('./classes/Articles.php');

    session_start();
    
    // Gebruiker nog niet ingelogged
    if(!isset($_SESSION['logged_in']))
    {
        // Login formulier gesubmit?
        if(isset($_POST['submit']))
        {
            // Kloppen de login gegevens?
            if($_POST['email'] == 'test@test.be' && $_POST['password'] == 'testtest')
            {
                // Alles klopt, you may proceed
                $_SESSION['logged_in'] = 1;
            }
            else
            {
                // Gegevens kloppen niet, foutmelding geven
                $msg = 'Wrong login and/or password';

                include('./pages/login.php');
            }
        }

        // Er is geen gebruiker ingelogged en er is ook nog niets verstuurd dus gewoon login form tonen
        if(!isset($_POST['submit']))
        {
            include('./pages/login.php');
        }
    }

    // Gebruiker is ingelogged
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1)
    {
        // Mechanisme om iemand uit te loggen via ?logout=1
        if(isset($_GET['logout']) && $_GET['logout'] == 1)
        {
            session_destroy();
            header('location: index.php');
        }

        // Als er geen pagina wordt meegegeven tonen we standaard de home page
        if(isset($_GET['page'])) $page = $_GET['page'];
        if(!isset($_GET['page'])) $page = 'home';

        include('./templates/header.php');

        switch($page)
        {
            case 'add': {
                include('./pages/add_article.php');
            }break;

            default: {
                include('./pages/home.php');
            }

        }

        include('./templates/footer.php');
    }
?>