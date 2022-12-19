<?php
    $action = $_GET['action'] ?? '';

    switch($action)
    {
        case 'add': {
            include './controllers/articles/add.php';
            include './templates/articles/form.php';
        }break;

        case 'edit': {
            include './controllers/articles/edit.php';
            include './templates/articles/form.php';
        }break;

        case 'delete': {
            include './controllers/articles/delete.php';
        }break;

        default: {
            include './controllers/articles/list.php';
            include './templates/articles/list.php';
        }
    }
