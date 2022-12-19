<?php
$id = $_GET['id'];

// Form submitted
if(isset($_POST['submit']))
{
    if(empty($_POST['title']) || empty($_POST['article']))
    {
        flash('msg', 'Please fill in all fields');
        flash('form', [
            'title' => $_POST['title'],
            'article' => $_POST['article']
        ]);

        redirect('index.php?page=articles&action=edit&id='. $id);
    }

    updateArticle($conn, $id, $_POST['title'], $_POST['article']);
    flash('msg', 'Article is updated');
    redirect('index.php?page=articles&action=edit&id='. $id);
}

// Fetch article
$article = getOneArticle($conn, $id);

if(empty($article))
{
    flash('msg', 'Article not found');
    redirect('index.php?page=articles');
}

// Meta data (because we're using the same template for this form)
$titel_action = 'Edit article';
$form_action = 'index.php?page=articles&action=edit&id='. $id;

// Prefill fields
$title = $article['title'];
$article = $article['article'];
