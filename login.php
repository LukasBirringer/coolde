<?php
session_start();

include_once("dbconfig.php");

$username = $_POST["username"];
$password = md5($_POST["password"]);

$abfrage = "SELECT * FROM login WHERE name = '$username' LIMIT 1";
$ergebnis = mysql_query($abfrage);
$row = mysql_fetch_object($ergebnis);

if($row && $row->pass == $password)
    {
    $_SESSION["name"] = $username;
    header("location:main.php");
    }
else
    {
    header("location:index.php");
    }
?>