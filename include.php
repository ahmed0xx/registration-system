<?php
session_start();
$username = 'root';
$password = '';
$dsn = 'mysql:host=localhost;dbname=users';

$con = new PDO($dsn, $username, $password);
?>