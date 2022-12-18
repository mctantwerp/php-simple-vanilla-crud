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

    $sql = "UPDATE articles SET title = :title, article = :article, updated_at = :updated_at WHERE id = :article_id";

    try
    {
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':article', $article, PDO::PARAM_STR);
        $stmt->bindParam(':updated_at', $now, PDO::PARAM_STR);
        $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);

        $stmt->execute();
    }
    catch(PDOException $e)
    {
        flash('msg', 'Oops, something went wrong: '. $e->getMessage());
        redirect('index.php?page=update');
    }

    return true;
}

function getArticles(PDO $conn, bool $withTrashed = false): object
{
    try
    {
        if($withTrashed === true)
        {
            $res = $conn->query('SELECT * FROM articles');
        }
        else
        {
            $res = $conn->query('SELECT * FROM articles WHERE deleted_at IS NULL');
        }

        return $res;
    }
    catch(PDOException $e)
    {
        flash('msg', '<strong>Oops, something went wrong:</strong> '. $e->getMessage());
        redirect('error.php');
    }
}

function getOneArticle(PDO $conn, int $article_id): array
{
    $sql = "SELECT * FROM articles where id = :article_id";

    try
    {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
        die();
    }

    return $stmt->fetch();
}

function deleteArticle(object $conn, int $article_id): bool
{
    $sql = "DELETE FROM articles where id = :article_id";

    try
    {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
        die();
    }

    return true;
}
