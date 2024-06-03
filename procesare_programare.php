<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <title>Barbershop</title>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css"> 
    <link href="css/style.css" rel="stylesheet">    
    <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #000000;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #753100;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        #buttons {
            text-align: center;
            margin-top: 20px;
        }

        #buttons button {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "frizerie";

        
        $conn = new mysqli($servername, $username, $password, $dbname);

        
        if ($conn->connect_error) {
            die("Conexiunea a eșuat: " . $conn->connect_error);
        }

        
        $nume = $_POST['nume'];
        $telefon = $_POST['telefon'];
        $data = $_POST['data'];
        $ora = $_POST['ora'];

        
        $sql_check = "SELECT ora FROM programari WHERE data = '$data' AND ora = '$ora'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            echo "<div class='error-message' style='color: #000;'>Programarea pentru ora $ora pe data de $data este deja rezervată.</div>";
            echo "<div id='buttons'>";
            echo "<button onclick=\"window.location.href='programare.html'\">Încearcă din nou</button>";
            echo "<button onclick=\"window.location.href='index.html'\">Pagina principală</button>";
            echo "</div>";
        } else {
            
            $sql = "INSERT INTO programari (nume, telefon, data, ora) VALUES ('$nume', '$telefon', '$data', '$ora')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='error-message' style='color: #000;'>Programare reazlizata cu succes.</div>";

                echo "<div id='buttons'>";
                echo "<button onclick=\"window.location.href='programare.html'\">Programare nouă</button>";
                echo "<button onclick=\"window.location.href='index.html'\">Pagina principala</button>";
                
                echo "</div>";
            } else {
                echo "Eroare: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
