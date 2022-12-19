<?php
    $action = $_GET['action'] ?? '';

    switch($action)
    {
        case 'add': {
            include './controllers/users/add.php';
            include './templates/users/form.php';
        }break;

        case 'edit': {
            include './controllers/users/edit.php';
            include './templates/users/form.php';
        }break;

        case 'delete': {
            include './controllers/users/delete.php';
        }break;

        default: {
            include './controllers/users/list.php';
            include './templates/users/list.php';
        }
    }
