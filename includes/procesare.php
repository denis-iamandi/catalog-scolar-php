<?php
include("config.php");

if(isset($_POST['nume'], $_POST['prenume'], $_POST['clasa'], $_POST['email'])){
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $clasa = $_POST['clasa'];
    $email = $_POST['email'];

    $sql = "INSERT INTO elevi (nume, prenume, clasa, email)
            VALUES ('$nume', '$prenume', '$clasa', '$email')";

    if(mysqli_query($conn, $sql)){
        echo "<p style='color:green;'>Elev adăugat cu succes!</p>";
    } else {
        echo "<p style='color:red;'>Eroare la inserare!</p>";
    }
}
?>

