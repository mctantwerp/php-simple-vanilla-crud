<?php
$id = $_GET['id'];

// Post submitted
if(isset($_POST['submit']))
{
    if(empty($_POST['email']))
    {
        flash('msg', 'Please fill in al lfields');
        flash('form', [
            'email' => $_POST['email'],
        ]);

        redirect('index.php?page=users&action=edit&id='. $id);
    }

    $password = $_POST['password'] ?? '';

    updateUser($conn, $id, $_POST['email'], $password);
    flash('msg', 'User is updated');
    redirect('index.php?page=users&action=edit&id='. $id);
}

// Fetch user
$user = getOneUser($conn, $id);

// Meta data (because we're using the same template for this form)
$titel_action = 'Edit user';
$form_action = 'index.php?page=users&action=edit&id='. $id;

// Prefill fields
$email = $user['email'];
