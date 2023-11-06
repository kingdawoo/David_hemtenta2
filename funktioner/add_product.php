<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lägg till produkt</title>
    <link rel="stylesheet" href="../css/product.css">
</head>
<body>
    <a href="../index.php">Meny</a>
    <form action="#" method="post" id="add-form" enctype="multipart/form-data"> <!-- enctype=... attr tillåter bilder att laddas upp genom formulär -->
        <label for="name">Namn: </label>
        <input type="text" name="name" id="name" required>

        <label for="description">Beskrivning: </label>
        <textarea type="text" id="description" name="description" rows="10" cols="50" required></textarea>

        <label for="price">Pris (kr): </label>
        <input type="text" name="price" id="price" max="9999">

        <label for="img-upload">Välj bild: </label>
        <input type="file" accept="image/png, image/jpeg" id="img-upload" name="img-upload">

        <input type="submit" value="Lägg till produkt" name="add" style="width: 150px;">
    </form>

    <?php
        if(isset($_POST["add"])) {

            // Databas info som krävs för att ansluta till mySQL o öppna en anslutning
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "crud_app";

            $conn = mysqli_connect($servername, $username, $password, $dbname); // ÖPPNA
            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }

            // Fånga inmatade värden från formuläret
            $product_name = $_POST["name"];
            $product_desc = $_POST["description"];
            $product_price = $_POST["price"];

            $target_dir = "../img/";
            $filepath = $target_dir . basename($_FILES["img-upload"]["name"]);
            move_uploaded_file($_FILES["img-upload"]["tmp_name"], $filepath);

            // Placera värden i tabellen inom databasen
            $sql = "INSERT INTO products (name, description, price, image)
            VALUES ('$product_name', '$product_desc', '$product_price', '$filepath')";

            // Skicka förfrågan (query)
            if (mysqli_query($conn, $sql)) {
                echo 'Produkt tillagd!';
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn); // STÄNG
        }
    ?>
</body>
</html>