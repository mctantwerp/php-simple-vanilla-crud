<?php
// Form submitted
if(isset($_POST['submit']))
{
    // Everything filled in?
    if(empty($_POST['title']) || empty($_POST['article']))
    {
        flash('msg', 'Please fill in all fields');
        flash('form', [
            'title' => $_POST['title'],
            'article' => $_POST['article']
        ]);

        redirect('index.php?page=add');
    }

    // Add article to database and show message
    addArticle($conn, getLoggedInUserId(), $_POST['title'], $_POST['article']);
    flash('msg', 'Article added');

    redirect('index.php?page=home');
}

// Meta data (because we're using the same template for this form)
$titel_action = 'Add article';
$form_action = 'index.php?page=articles&action=add';
