<?php
$servername = "localhost";
$username = "cat2mc_minecraft";
$password = "cat2mc_minecraft";
$dbname = "cats";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT owner_uuid, type, name, health FROM playercats";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> owner_uuid: ". $row["owner_uuid"]. " - type: ". $row["type"]. " - name: ". $row["name"]. " - health: ". $row["health"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
