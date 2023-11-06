<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ta bort produkt</title>
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

        // Skriv ut en formulär med all data och en 'delete' knapp med associerad id
        $delete_form = '<form method="post" action="#" id="del-form">';
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $delete_form .= "<div class='products-item'>" .
                "<div class='name'>" . $row["name"] . "</div>" . // Namn
                "<div class='price'>" . $row["price"] . " kr</div>" . // Pris
                "<div class='image'>" . "<img width=200px src=" . $row["image"] . ">" . "</div>" . // Bild
                "<div class='text'>" . $row["description"] . "</div>" . // Description
                "<input type='hidden' name='product_id' value='" . $row['id'] . "'>" . // Gömd inmatning som lagrar produkt id
                "<input type='submit' name='delete_" . $row['id'] . "' value='Ta bort'>" . // Ta bort knapp
                "</div>";
            }
        } else {
            echo "<br><br>0 resultat";
        }
        $delete_form .= '</form>';
        echo $delete_form;

        // Matcha korrekt id från submit och sedan ta bort den raden
        if(isset($_POST)) {
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'delete_') === 0) {
                    $product_id = substr($key, 7);
                    $sql = "DELETE FROM products WHERE id = $product_id";
        
                    if (mysqli_query($conn, $sql)) {
                        header("Location: delete_product.php");
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                }
            }
        }
        
    
        mysqli_close($conn); // STÄNG
    ?>
</body>
</html>