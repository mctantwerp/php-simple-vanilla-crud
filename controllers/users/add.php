<?php
// Form submitted
if(isset($_POST['submit']))
{
    // All fields filled in?
    if(empty($_POST['email']) || empty($_POST['password']))
    {
        flash('msg', 'Please fill in all fields');
        flash('form', [
            'email' => $_POST['title'],
        ]);

        redirect('index.php?page=users&action=add');
    }

    // Add user to database, if succesful, show message
    addUser($conn, $_POST['email'], $_POST['password']);
    flash('msg', 'User added');

    redirect('index.php?page=users');
}

// Meta data (because we're using the same template for this form)
$titel_action = 'Add user';
$form_action = 'index.php?page=users&action=add';
