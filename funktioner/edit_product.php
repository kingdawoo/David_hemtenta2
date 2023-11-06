<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ändra produkt</title>
    <link rel="stylesheet" href="../css/product.css">
</head>
<body>
<a href="../index.php">Meny</a>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_app";

$conn = mysqli_connect($servername, $username, $password, $dbname); // ÖPPNA
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ta produkt data från tabellen i databasen
$sql = "SELECT p.id, p.name, p.description, p.price, p.image FROM products p";
$result = mysqli_query($conn, $sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}

// Skriv ut all data + de extra redigering inmatningarna
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Skapa separat formulär för varje produkt
        echo '<form method="post" action="#" enctype="multipart/form-data">';
        echo "<div class='products-item'>" .
            "<div class='name'>" . $row["name"] . "</div>" . // Namn
            "<div class='price'>" . $row["price"] . " kr</div>" . // Pris
            "<div class='image'>" . "<img width=200px alt='Produkt' src=" . $row["image"] . ">" . "</div>" . // Bild
            "<div class='text'>" . $row["description"] . "</div>" . // Description
            "<input type='hidden' name='product_id' value='" . $row['id'] . "'>" . // Gömd inmatning som lagrar produkt id
            "<input type='text' name='price' placeholder='Nytt pris' max='9999'>" . // Nytt pris
            "<input type='file' accept='image/png, image/jpeg' id='img-upload' name='img-upload'>" . // Ny bild
            "<input type='submit' name='edit' value='Redigera'>" . // Redigera knapp
            "</div>";
        echo '</form>';
    }
} else {
    echo "<br><br>0 resultat";
}

// När knappen trycks ta de nya värdena o uppdatera de i tabellen
if (isset($_POST['edit'])) {
    $product_id = $_POST['product_id'];
    $product_newprice = $_POST['price'];

    $target_dir = "../img/";
    $filepath = $target_dir . basename($_FILES["img-upload"]["name"]);
    move_uploaded_file($_FILES["img-upload"]["tmp_name"], $filepath);

    $sql = "UPDATE products
            SET price = '$product_newprice', image = '$filepath'
            WHERE id = $product_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: edit_product.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn); // STÄNG
?>
</body>
</html>
