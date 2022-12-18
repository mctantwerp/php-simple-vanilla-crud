<?php
    $action = (isset($_GET['action'])) ? $_GET['action'] : '';

    switch($action)
    {
        case 'edit': {
            $id = $_GET['id'];

            // Aanpassingen gepost
            if(isset($_POST['submit']))
            {
                if(empty($_POST['title']) || empty($_POST['article']))
                {
                    flash('msg', 'Vul alle velden in svp');
                    flash('form', [
                        'title' => $_POST['title'],
                        'article' => $_POST['article']
                    ]);

                    redirect('index.php?page=home&action=edit&id='. $id);
                }

                updateArticle($conn, $id, $_POST['title'], $_POST['article']);
                flash('msg', 'Artikel is aangepast');
                redirect('index.php?page=home&action=edit&id='. $id);
            }

            // Artikel ophalen
            $article = getOneArticle($conn, $id);

            // Meta data (omdat formulier door add & edit wordt gebruikt)
            $titel_action = 'Artikel aanpassen';
            $form_action = 'index.php?page=home&action=edit&id='. $id;

            // Prefill fields
            $title = $article['title'];
            $article = $article['article'];

            include('./templates/article_form.php');
        }break;

        case 'delete': {
            deleteArticle($conn, $_GET['id']);

            flash('msg', 'Artikel is verwijderd');
            redirect('index.php?page=home');
        }break;

        default: {
            $articles = getArticles($conn);

            include('./templates/list_articles.php');
        }
    }
