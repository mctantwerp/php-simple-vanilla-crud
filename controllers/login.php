<?php
// User is not logged in
if(!isset($_SESSION['logged_in']))
{
    // Form submitted?
    if(isset($_POST['submit']))
    {
        // Get user from database
        $user = getUserByEmail($conn, $_POST['email']);

        // Are the credentials correct?
        if($user && password_verify($_POST['password'], $user['password']))
        {
            // Everything is correct, you can proceed
            $_SESSION['logged_in'] = 1;
            $_SESSION['user_id'] = $user['id'];
            redirect('index.php');
        }
        else
        {
            // Login data wrong, redirect to login page
            flash('msg', 'Wrong login and/or password');
            flash('form', [
                'email' => $_POST['email'],
            ]);
            redirect('index.php');
        }
    }

    $page = 'login';
}
