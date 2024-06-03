<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <title>Barbershop - Procesare Anulare</title>
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

        p {
            text-align: center;
            color: #000; 
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Procesare Anulare Programare</h1>
        <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (isset($_POST['telefon'])) {
                
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "frizerie";

                $conn = new mysqli($servername, $username, $password, $dbname);

                
                if ($conn->connect_error) {
                    die("Conexiune eșuată: " . $conn->connect_error);
                }

                
                $telefon = mysqli_real_escape_string($conn, $_POST['telefon']);

                
                $sql = "DELETE FROM programari WHERE telefon='$telefon'";

                if ($conn->query($sql) === TRUE) {
                    echo "<p>Programarea a fost anulată cu succes.</p>";
                } else {
                    echo "<p>Eroare la anularea programării: " . $conn->error . "</p>";
                }

               
                $conn->close();
            } else {
                echo "<p>Numărul de telefon lipsește din cererea POST.</p>";
            }
        } else {
            echo "<p>Această pagină acceptă doar cereri POST.</p>";
        }
        ?>
        <a href="anulare_programare.html"><button>Înapoi</button></a>
        <a href="index.html"><button>Pagina principala</button></a>
    </div>
</body>
</html>
