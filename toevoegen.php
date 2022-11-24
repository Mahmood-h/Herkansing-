<?php
session_start();
try {
    $db = new PDO("mysql:host=localhost;dbname=fietsen",
        "root", "");

    if (isset($_POST["submit"])) {

        $_SESSION["naam"] = filter_input(INPUT_POST, "naam", FILTER_SANITIZE_STRING);
        $_SESSION["beschrijving"] = filter_input(INPUT_POST, "beschrijving", FILTER_SANITIZE_STRING);
        $_SESSION["voorraad"] = filter_input(INPUT_POST, "voorraad", FILTER_SANITIZE_STRING);
        $_SESSION["prijs"] = filter_input(INPUT_POST, "prijs", FILTER_SANITIZE_EMAIL);


        $naam = $_SESSION['naam'];
        $beschrijving = $_SESSION['beschrijving'];
        $prijs = $_SESSION['prijs'];
        $voorraad = $_SESSION['voorraad'];





        $query = $db->prepare("INSERT INTO model(naam, beschrijving, prijs, voorraad)
   VALUES (:naam, :beschrijving, :prijs, :voorraad )");

        $query->bindParam("naam", $naam);
        $query->bindParam("beschrijving", $beschrijving);
        $query->bindParam("prijs", $prijs);
        $query->bindParam("voorraad", $voorraad);


        if ($query->execute()) {
            header("Location: select.php");
        } else {
            echo "Er is een fout opgetreden";
        }
        echo "<br>";
    }
}catch (PDOException $e){
    die("Error!:". $e->getMessage());
}


?>



<!doctype html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css">
    <title>Hello, world!</title>
</head>
<body>
<nav class="index  position-sticky top-0 navbar navbar-expand-lg navbar-light bg-primary ">
    <div class="container-fluid">
        <a class="navbar-brand text-light"href="index.php">Fietsen beheer</a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</nav>


<form method="post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Merk</label>
        <input type="text" name="naam" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Beschrijving</label>
        <input type="text" name="beschrijving" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Prijs</label>
        <input type="text" name="prijs" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Voorraad</label>
        <input type="number" name="voorraad" class="form-control" id="exampleInputPassword1">
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Voeg toe</button>
</form>