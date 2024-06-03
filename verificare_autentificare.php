<?php

if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin') {
    
    header("Location: vizualizare_programari.php");
    exit(); 
} else {
    
    echo "<script>alert('Nume de utilizator sau parolă incorecte!'); window.location.href = 'autentificare.html';</script>";
}
?>
