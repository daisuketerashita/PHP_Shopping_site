<?php
require_once('env.php');

$host = DB_HOST;
$db = DB_NAME;
$user = DB_USER;
$pass = DB_PASS;

$dsn = "mysql:host=$host;dbname=$db;charset=utf8";
