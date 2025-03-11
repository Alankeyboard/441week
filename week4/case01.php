<?php
$servername = "sql306.infinityfree.com"; // replace with your MySQL server address
$dbname = "if0_37507189_first"; // replace with your MySQL database name
$username = "if0_37507189"; // replace with your MySQL username
$password = "Lyy2956522720"; // replace with your MySQL password
 
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
die("Connection failed: ". $conn->connect_error);
}


$sql = "SELECT id, subject, day, time, teacher FROM timetable";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Timetable Data</title>
<style>
table {
width: 100%;
border-collapse: collapse;
}

th,
td {
border: 1px solid #ddd;
padding: 8px;
text-align: left;
}

th {
background-color: #f2f2f2;
}
</style>
</head>

<body>
<h1>Timetable Data</h1>
<?php
if ($result->num_rows > 0) {
// Output data of each row
echo "<table>";
echo "<tr><th>ID</th><th>Subject</th><th>Day</th><th>Time</th><th>Teacher</th></tr>";
while ($row = $result->fetch_assoc()) {
echo "<tr>";
echo "<td>". $row["id"]. "</td>";
echo "<td>". $row["subject"]. "</td>";
echo "<td>". $row["day"]. "</td>";
echo "<td>". $row["time"]. "</td>";
echo "<td>". $row["teacher"]."</td>";
echo "</tr>";
}
echo "</table>";
} else {
echo "No records found in the timetable table.";
}
$conn->close();
?>
</body>

</html>