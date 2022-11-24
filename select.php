<?php
session_start();
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
<style type="text/css">
    table {
        border-collapse: collapse;
        border: 1px solid black;
    }
    td{
        border: 1px solid black;
        width: 150px;
    }


</style>



<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=fietsen",
        "root", "");

    $query = $db->prepare("SElECT * FROM model");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    echo "<table>";
    echo "<tr>";
    echo "<td> Id </td>";
    echo "<td> Merk </td>";
    echo "<td> Prijs </td>";
    echo "<td> Beschrijving </td>";
    echo "<td> Voorraad </td>";


    echo "</tr>";
    echo "<table>";
    $teller=1;
    foreach ($result as $data) {

        echo "<table>";
        echo "<tr>";
        echo "<td>". $teller. "</td>";
        echo "<td>". $data["naam"]."</td>";
        echo "<td>". $data["prijs"]."</td>";
        echo "<td>". $data["beschrijving"]."</td>";
        echo "<td>". $data["voorraad"]."</td>";
        echo "<td> <a href='detail.php?id=". $data["id"]."'>Detail</a>";
        echo "<td> <a href='update.php?id=". $data["id"]."'>Update</a>";
        echo "<td> <a href='delete.php?id=". $data["id"]."'>Delete</a>";
        $teller++;



        echo "</tr>";
        echo "</table>";
    }
    echo "<br>";
}catch (PDOException $e){
    die("Error!:". $e->getMessage());
}
?>
<a href="toevoegen.php">Insert</a>