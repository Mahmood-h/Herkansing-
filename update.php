<?php
if (isset($_POST['submit'])){
    if (!empty($_POST['naam']) && (!empty($_POST['beschrijving']) && (!empty($_POST['prijs']) && (!empty($_POST['voorraad']))))){
        $naam= filter_input(INPUT_POST, 'naam', FILTER_SANITIZE_STRING);
        $beschrijving= filter_input(INPUT_POST, 'beschrijving', FILTER_SANITIZE_STRING);
        $prijs= filter_input(INPUT_POST, 'prijs', FILTER_SANITIZE_NUMBER_FLOAT);
        $voorraad= filter_input(INPUT_POST, 'voorraad', FILTER_SANITIZE_NUMBER_FLOAT);

        if ($prijs === false || $voorraad=== false){
            $bericht= "Vul een getal in";
        } else{
            $db= new PDO("mysql:host=localhost;dbname=fietsen",
            "root", "");
            $query=$db->prepare("UPDATE model SET naam=:naam,beschrijving=:beschrijving, prijs=:prijs, voorraad=:voorraad WHERE id=".$_GET['id']);
            $query->bindParam("naam", $naam);
            $query->bindParam("beschrijving", $beschrijving);
            $query->bindParam("prijs", $prijs);
            $query->bindParam("voorraad", $voorraad);
            $query->execute();

            header("Location:select.php");

        }
    } else{
        $bericht="Vul alles in";
    }
} else{
    $db= new PDO("mysql:host=localhost;dbname=fietsen",
        "root", "");
    $query= $db->prepare("SELECT * FROM model WHERE id=:id");
    $query->bindParam("id", $_GET['id']);
    $query->execute();
    $fiets=$query->fetch(PDO::FETCH_ASSOC);


             $naam =$fiets['naam'];
             $beschrijving =$fiets['beschrijving'];
             $prijs =$fiets['prijs'];
             $voorraad =$fiets['voorraad'];

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
        <input type="text" name="naam" value="<?php echo $naam;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Beschrijving</label>
        <input type="text" name="beschrijving" value="<?php echo $beschrijving;?>" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Prijs</label>
        <input type="text" name="prijs" value="<?php echo $prijs;?>" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Voorraad</label>
        <input type="number" name="voorraad" value="<?php echo $voorraad;?>"  class="form-control" id="exampleInputPassword1">
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
