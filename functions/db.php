<?php

function dbConnect(): object
{
    $conn = new PDO("mysql:host=localhost;dbname=kdg-crud-demo;charset=utf8", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conn;
}
