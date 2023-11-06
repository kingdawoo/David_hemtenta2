<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se alla produkter</title>
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
        $sql = "SELECT p.id, p.name, p.description, p.price, p.image
        FROM products p";
        $result = mysqli_query($conn, $sql);  

        if (!$result) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
        }

        // Skriv ut alla produkter på sidan i korrekt html-element
        $products = '<div class="products">';
        if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) { // <- ta associative array från förfrågan
            $products .= "<div class='products-item'>" .
            "<div class='name'>" . $row["name"] . "</div>" . // Namn
            "<div class='price'>" . $row["price"] . " kr</div>" . // Pris
            "<div class='image'>" . "<img width=200px src=".$row["image"].">" . "</div>" . // Bild
            "<div class='text'>" . $row["description"] . "</div>" . // Beskrivning
            "</div>"; 
        }
        } else {
        echo "<br><br>0 resultat";
        }
        $products .= '</div>';
        echo $products;

        mysqli_close($conn); // STÄNG
    ?>
</body>
</html>