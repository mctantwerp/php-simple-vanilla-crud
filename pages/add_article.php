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
        if(empty($_POST['title']) || empty($_POST['article']))
        {
            flash('msg', 'Vul alle velden in svp');
            flash('form', [
                'title' => $_POST['title'],
                'article' => $_POST['article']
            ]);

            redirect('index.php?page=add');
        }

        // Article toevoegen in database, als dat lukt, boodschap tonen
        addArticle($conn, 1, $_POST['title'], $_POST['article']);
        flash('msg', 'Artikel toegevoegd');

        redirect('index.php?page=home');
    }
