<?php

    $action = (isset($_GET['action'])) ? $_GET['action'] : '';

    switch($action)
    {
        case 'edit': {
            $id = $_GET['id'];

            // Aanpassingen gepost
            if(isset($_POST['submit']))
            {
                Articles::update($id, $_POST['titel'], $_POST['inhoud']);
                $msg = "Artikel is aangepast";
            }

            // Artikel ophalen
            $artikel = Articles::getOne($id);

            // Meta data (omdat formulier door add & edit wordt gebruikt)
            $titel_action = 'Artikel aanpassen';
            $form_action = 'index.php?page=home&action=edit&id='. $id;

            // Prefill fields
            $titel = $artikel['titel'];
            $inhoud = $artikel['inhoud'];

            include('./templates/article_form.php');
        }break;

        case 'delete': {
            Articles::delete($_GET['id']);

            $msg = "Artikel is verwijderd";

            $artikels = Articles::get();

            include('./templates/list_articles.php');
        }break;

        default: {
            $artikels = Articles::get();

            include('./templates/list_articles.php');
        }
    }