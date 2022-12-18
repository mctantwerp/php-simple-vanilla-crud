<?php

function addUser(PDO $conn, string $email, string $password): bool
{
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $password = password_hash($password, PASSWORD_DEFAULT);

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
        redirect('users.php?page=users&action=add');
    }

    return true;
}

function updateUser(PDO $conn, int $user_id, string $email, string $password): bool
{
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $now = getCurrentDateTime();

    if(!empty($password))
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET email = :email, password = :password, updated_at = :updated_at WHERE id = :user_id";
    }
    else
    {
        $sql = "UPDATE users SET email = :email, updated_at = :updated_at WHERE id = :user_id";
    }


    try
    {
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $stmt->bindParam(':updated_at', $now, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if(!empty($password))
        {
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        }

        $stmt->execute();
    }
    catch(PDOException $e)
    {
        flash('msg', 'Oops, something went wrong: '. $e->getMessage());
        redirect('users.php?page=update');
    }

    return true;
}

function getUsers(PDO $conn, bool $withTrashed = false): object
{
    try
    {
        if($withTrashed === true)
        {
            $res = $conn->query('SELECT * FROM users');
        }
        else
        {
            $res = $conn->query('SELECT * FROM users WHERE deleted_at IS NULL');
        }

        return $res;
    }
    catch(PDOException $e)
    {
        flash('msg', '<strong>Oops, something went wrong:</strong> '. $e->getMessage());
        redirect('index.php');
    }
}

function getOneUser(PDO $conn, int $user_id): array
{
    $sql = "SELECT * FROM users where id = :user_id";

    try
    {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch(PDOException $e)
    {
        flash('msg', '<strong>Oops, something went wrong:</strong> '. $e->getMessage());
        redirect('users.php');
    }

    return $stmt->fetch();
}

function getUserByEmail(PDO $conn, string $email): bool|array
{
    $sql = "SELECT * FROM users where email = :email";

    try
    {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch(PDOException $e)
    {
        flash('msg', '<strong>Oops, something went wrong:</strong> '. $e->getMessage());
        redirect('index.php');
    }

    return $stmt->fetch();
}

function deleteUser(object $conn, int $user_id): bool
{
    $sql = "UPDATE users SET deleted_at = :deleted_at WHERE id = :user_id";
    $now = getCurrentDateTime();

    try
    {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':deleted_at', $now, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch(PDOException $e)
    {
        flash('msg', '<strong>Oops, something went wrong:</strong> '. $e->getMessage());
        redirect('users.php');
    }

    return true;
}
