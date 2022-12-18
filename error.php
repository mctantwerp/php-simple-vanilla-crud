<?php
    session_start();
    $page = 'error';

    include('./vendor/autoload.php');
    include('./functions/helpers.php');
    include('./templates/header.php');
?>

    <div class="container main">
    <?php
        if(!empty($msg = flash('msg.errors')))
        {
            echo '<div class="alert alert-danger" role="alert">';
            echo $msg;
            echo '</div>';
        }
    ?>
    </div>

<?php
    include('./templates/footer.php');
?>
