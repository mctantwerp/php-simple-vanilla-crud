<?php

function addArticle(PDO $conn, int $user_id, string $title, string $article): bool
{
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $article = htmlspecialchars($article, ENT_QUOTES, 'UTF-8');

    $sql = "INSERT INTO articles SET user_id = :user_id, title = :title, article = :article";

    try
    {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':article', $article, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch(PDOException $e)
    {
        flash('msg', 'Oops, something went wrong: '. $e->getMessage());
        redirect('index.php?page=add');
    }

    return true;
}

function updateArticle(PDO $conn, int $article_id, string $title, string $article): bool
{
    $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $article = htmlspecialchars($article, ENT_QUOTES, 'UTF-8');
    $now = getCurrentDateTime();

    $sql = "UPDATE articles SET title = :title, article = :article, updated_at = :updated_at WHERE user_id = :user_id AND id = :article_id";
    $user_id = getLoggedInUserId();

    try
    {
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':article', $article, PDO::PARAM_STR);
        $stmt->bindParam(':updated_at', $now, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);

        $stmt->execute();
    }
    catch(PDOException $e)
    {
        flash('msg', 'Oops, something went wrong: '. $e->getMessage());
        redirect('index.php?page=home&action=update&id='. $article_id);
    }

    return true;
}

function getArticles(PDO $conn, bool $withTrashed = false): object
{
    try
    {
        if($withTrashed === true)
        {
            $res = $conn->query('SELECT * FROM articles WHERE user_id = '.getLoggedInUserId());
        }
        else
        {
            $res = $conn->query('SELECT * FROM articles WHERE user_id = '.getLoggedInUserId() .' and deleted_at IS NULL');
        }

        return $res;
    }
    catch(PDOException $e)
    {
        flash('msg', '<strong>Oops, something went wrong:</strong> '. $e->getMessage());
        redirect('index.php');
    }
}

function getOneArticle(PDO $conn, int $article_id): bool|array
{
    $sql = "SELECT * FROM articles WHERE user_id = :user_id AND id = :article_id";
    $user_id = getLoggedInUserId();

    try
    {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch(PDOException $e)
    {
        flash('msg', '<strong>Oops, something went wrong:</strong> '. $e->getMessage());
        redirect('index.php');
    }

    return $stmt->fetch();
}

function deleteArticle(object $conn, int $article_id): bool
{
    $sql = "UPDATE articles SET deleted_at = :deleted_at WHERE id = :article_id";
    $now = getCurrentDateTime();

    try
    {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':deleted_at', $now, PDO::PARAM_STR);
        $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch(PDOException $e)
    {
        flash('msg', '<strong>Oops, something went wrong:</strong> '. $e->getMessage());
        redirect('index.php');
    }

    return true;
}
