<?php
    $titel_action = 'Artikel toevoegen';
    $form_action = 'index.php?page=add';

    // Er is nog niets verstuurd, formulier tonen
    if(!isset($_POST['submit']))
    {
        include('./templates/article_form.php');
    }

    // Formulier is ingevuld en verstuurd
    if(isset($_POST['submit']))
    {
        // Alles wel ingevuld?
        if(empty($_POST['titel']) || empty($_POST['inhoud']))
        {
            $msg = 'Vul alle velden in svp';

            // Als bvb. 1 van de 2 velden al ingevuld was gaan we die terug prepopulaten
            $titel = $_POST['titel'];
            $inhoud = $_POST['inhoud'];

            include('./templates/article_form.php');    
        }

        if(!empty($_POST['titel']) && !empty($_POST['inhoud']))
        {
            // Article toevoegen in database, als dat lukt, boodschap tonen
            if(Articles::add($_POST['titel'], $_POST['inhoud'])) {
                $msg = 'Artikel toegevoegd';

                include('./templates/article_form.php');
            }
        }
    }