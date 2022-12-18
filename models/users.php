<?php

function addUser(PDO $conn, string $email, string $password): bool
{
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

    $sql = "INSERT INTO users SET email = :email, password = :password";

    try
    {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch(PDOException $e)
    {
        flash('msg', 'Oops, something went wrong: '. $e->getMessage());
        redirect('users.php?page=add');
    }

    return true;
}

function updateUser(PDO $conn, int $user_id, string $email, string $password): bool
{
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $now = getCurrentDateTime();

    $sql = "UPDATE users SET email = :email, password = :password, updated_at = :updated_at WHERE id = :user_id";

    try
    {
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
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
