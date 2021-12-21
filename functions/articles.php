<?php

function addArticle(object $conn, string $titel, string $inhoud): bool
{
    $sql = "INSERT INTO artikels SET titel = ?, inhoud = ?";

    try
    {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$titel, $inhoud]);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
        die();
    }

    return true;

}

function updateArticle(object $conn, int $id, string $titel, string $inhoud): bool
{
    $sql = "UPDATE artikels SET titel = ?, inhoud = ? WHERE id = ?";

    try
    {
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $titel, PDO::PARAM_STR);
        $stmt->bindParam(2, $inhoud, PDO::PARAM_STR);
        $stmt->bindParam(3, $id, PDO::PARAM_INT);

        $stmt->execute();
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
        die();
    }

    return true;

}

function getArticle($conn): object
{
    return $conn->query('select * from artikels');
}

function getOneArticle(object $conn, int $id): array
{
    $sql = "SELECT * FROM artikels where id = ?";

    try
    {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
        die();
    }

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deleteArticle(object $conn, int $id): bool
{
    $sql = "DELETE FROM artikels where id = ?";

    try
    {
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
        die();
    }

    return true;
}
