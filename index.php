<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Initialize</title>
</head>
<body>
    <a href="">Lägg till produkt</a>
    <a href="">Se alla produkter</a>
    <a href="">Ändra pris/bild på produkt</a>
    <a href="">Ta bort produkt</a>
</body>
</html>

<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "crud_app";

// // ! SKAPA ANSLUTNING !

// $conn = mysqli_connect($servername, $username, $password, $dbname);
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }

// ! SKAPA DATABAS !

// $sql = "CREATE DATABASE crud_app";
// if (mysqli_query($conn, $sql)) {
//   echo "Database created successfully";
// } else {
//   echo "Error creating database: " . mysqli_error($conn);
// }

// ! SKAPA TABELL !

// $sql = "CREATE TABLE products (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(30) NOT NULL,
//     description VARCHAR(255) NOT NULL,
//     price FLOAT(50) NOT NULL,
//     image VARCHAR(2000) NOT NULL
//     )";
    
//     if (mysqli_query($conn, $sql)) {
//       echo "Table products created successfully";
//     } else {
//       echo "Error creating table: " . mysqli_error($conn);
//     }

// mysqli_close($conn);
?>