<?php
$db= new PDO("mysql:host=localhost;dbname=fietsen",
 "root", "");
if (isset($_GET['id'])){
    $id=filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    $query= $db->prepare("DELETE FROM model WHERE id=:id");
    $query->bindParam("id", $id);
    $query->execute();
    header("Location:select.php");
}
?>