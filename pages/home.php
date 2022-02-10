<?php

    $action = (isset($_GET['action'])) ? $_GET['action'] : '';

    switch($action)
    {
        case 'edit': {
            $id = $_GET['id'];

            // Aanpassingen gepost
            if(isset($_POST['submit']))
            {
                $artikel = new Article($id);

                $artikel->titel = $_POST['titel'];
                $artikel->inhoud = $_POST['inhoud'];

                $artikel->save();

                $msg = "Artikel is aangepast";
            }

            // Artikel ophalen
            $artikel = new Article($id);

            // Meta data (omdat formulier door add & edit wordt gebruikt)
            $titel_action = 'Artikel aanpassen';
            $form_action = 'index.php?page=home&action=edit&id='. $id;

            // Prefill fields
            $titel = $artikel->titel;
            $inhoud = $artikel->inhoud;

            include('./templates/article_form.php');
        }break;

        case 'delete': {
            $id = $_GET['id'] ?? null;

            $artikel = new Article($id);
            $artikel->delete();

            /**
             * Wat ook kan
             */
            /*
            $artikel = new Article();
            $artikel = $artikel->find($id)->delete();
            */

            $msg = "Artikel is verwijderd";

            $artikels = Article::get();

            include('./templates/list_articles.php');
        }break;

        default: {
            $artikels = Article::get();

            include('./templates/list_articles.php');
        }
    }
