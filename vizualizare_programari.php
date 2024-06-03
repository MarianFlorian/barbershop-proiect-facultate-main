<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizualizare Programări</title>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&amp;subset=cyrillic" rel="stylesheet">
    <style>
        body {
            font-family: 'PT Sans Narrow', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #000;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-container {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-container input[type=text] {
            padding: 10px;
            margin: 15px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #555;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-delete:hover {
            background-color: #d32f2f;
        }

        footer {
            background-color: #000;
            color: #fff;
            padding: 35px;
            text-align: center;
        }

        #data {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        #data:focus {
            outline: none;
            border-color: #333;
        }

        .btn-filter {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-filter:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Programări Frizerie</h1>

        <form method="get" action="">
            <label for="data">Selectați data:</label>
            <input type="date" id="data" name="data" value="<?php echo date('Y-m-d'); ?>">
            <button class="btn-filter" type="submit">Filtrare</button>
        </form>
        
        <div class="search-container">
            <input type="text" id="searchName" onkeyup="searchTable('name')" placeholder="Caută după nume...">
            <input type="text" id="searchPhone" onkeyup="searchTable('phone')" placeholder="Caută după telefon...">
        </div>

        <table id="programariTable">
            <tr>
                <th>Nume</th>
                <th>Număr de Telefon</th>
                <th>Data</th>
                <th>Ora</th>
                <th>Șterge</th>
            </tr>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "frizerie";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexiunea a eșuat: " . $conn->connect_error);
            }

            if (isset($_GET['data'])) {
                $selectedDate = $_GET['data'];
            } else {
                $selectedDate = date('Y-m-d');
            }

            $sql = "SELECT * FROM programari WHERE data = '$selectedDate'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nume'] . "</td>";
                    echo "<td>" . $row['telefon'] . "</td>";
                    echo "<td>" . $row['data'] . "</td>";
                    echo "<td>" . $row['ora'] . "</td>";
                    echo "<td><form action='stergere_programare.php' method='post'>
                              <input type='hidden' name='id_programare' value='" . $row['id'] . "'>
                              <button class='btn-delete' type='submit'>Șterge</button>
                          </form></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nu există programări pentru data selectată.</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>

    <footer>
        <a href="index.html"><button class="button" type="button">ACASĂ</button></a>
        <a href="programare.html"><button class="button" type="button">Programare noua</button></a>
    </footer>

    <script>
        function searchTable(filterType) {
            var input, filter, table, tr, td, i, txtValue;
            if (filterType === 'name') {
                input = document.getElementById("searchName");
            } else if (filterType === 'phone') {
                input = document.getElementById("searchPhone");
            }
            filter = input.value.toUpperCase();
            table = document.getElementById("programariTable");
            tr = table.getElementsByTagName("tr");
            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[filterType === 'name' ? 0 : 1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }
    </script>
</body>
</html>
