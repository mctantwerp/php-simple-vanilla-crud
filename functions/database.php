<?php

/**
 * Vanaf php 8.2 kan je #[\SensitiveParameter] gebruiken bij paswoord
 * @param string $user
 * @param string $pass
 * @param string $db
 * @param string $host
 * @return PDO
 */
function dbConnect(string $user, string $pass, string $db, string $host = 'localhost'): PDO
{
    $conn = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conn;
}
