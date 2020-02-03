<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "dblpa";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Connection failed: ".mysqli_connection_error());
}