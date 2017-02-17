<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$db = new PDO('mysql:host=localhost;dbname=testdb;charset=utf8mb4', 'username', 'password');


function connectDB() {
    $host = "localhost";
    $dbname = "abridge";
    $username = "root";
    $password = "";
    $db = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8mb4', $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return $db;
}
