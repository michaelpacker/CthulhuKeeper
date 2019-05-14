<?php

$host       = "localhost"; // change to production database credentials
$login      = "phpuser"; // change to production database credentials
$password   = "phpuser"; // change to production database credentials
$database   = "cthulhu_keeper"; // change to production database credentials

$conn = new mysqli($host, $login, $password, $database);

if($conn -> connect_errno) {
    $errno = $conn -> connect_errno;
    $errmsg = $con -> connect_error;
    die("Connection to database failed: ($errno) $errmsg.");
}