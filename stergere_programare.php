<?php

if(isset($_POST['id_programare'])) {
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "frizerie";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexiunea a eșuat: " . $conn->connect_error);
    }

    
    $id_programare = $_POST['id_programare'];
    $sql = "DELETE FROM programari WHERE id = $id_programare";

    
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location.href = 'vizualizare_programari.php';</script>";

    } else {
        echo "Eroare la ștergere: " . $conn->error;
    }

    
    $conn->close();
} else {
    
    echo "Eroare: Nu s-a furnizat id-ul programării pentru ștergere.";
}
?>
