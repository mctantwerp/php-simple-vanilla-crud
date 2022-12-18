<?php
    include('./vendor/autoload.php');
    include('./functions/database.php');
    include('./functions/helpers.php');
    include('./models/articles.php');
    include('./models/users.php');

    $conn = dbConnect(
        user: 'root',
        pass: '',
        db: 'kdg_crud',
    );

    registerExceptionHandler();
    session_start();

    // Get active page, set default page to articles
    $page = $_GET['page'] ?? 'articles';

    include './controllers/login.php';
    include './controllers/logout.php';

    switch($page)
    {
        case 'users': {
            include './templates/header.php';
            include './pages/users.php';
            include './templates/footer.php';
        }break;

        case 'login': {
            include './pages/login.php';
        }break;

        default: {
            include './templates/header.php';
            include './pages/articles.php';
            include './templates/footer.php';
        }
    }
?>
