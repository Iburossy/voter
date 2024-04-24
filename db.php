<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// // $dbname = "missmister_db";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }




$servername = "mysql-missmister.alwaysdata.net";
$username = "356489";
$password = "MisterMis24@";
$dbname = "missmister_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
