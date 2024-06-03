<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "frizerie";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['date'])) {
    $date = $_GET['date'];

    $sql = "SELECT ora FROM programari WHERE data = '$date'";
    $result = $conn->query($sql);
    $reservedTimes = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $reservedTimes[] = $row['ora'];
        }
    }

    $allTimes = array('09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00');
    $availableTimes = array_diff($allTimes, $reservedTimes);

    header('Content-Type: application/json');
    echo json_encode(array('times' => array_values($availableTimes)));
} else {
    echo json_encode(array('error' => 'Invalid request'));
}

$conn->close();
?>
