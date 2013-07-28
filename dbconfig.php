<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "coold";


mysql_connect("$host", "$user", "$password")or die("Verbindungsfehler");
mysql_select_db("$db")or die("DB nicht ausw&auml;hlbar");
?>