<?php
// Database configuration
$servername = "sql306.infinityfree.com";
$username = "if0_37507189"; // Change to your database username
$password = "Lyy2956522720";     // Change to your database password
$dbname = "if0_37507189_first"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = file_get_contents('php://input');
$classes = json_decode($data, true);

if (!empty($classes)) {
    // Updated SQL query to include the 'teacher' field
    $stmt = $conn->prepare("INSERT INTO timetable (subject, day, time, teacher) VALUES (?, ?, ?, ?)");

    foreach ($classes as $class) {
        $subject = $class['subject'];
        $day = $class['day'];
        $time = $class['time'];
        $teacher = $class['teacher']; // New field

        // Updated bind_param to include the 'teacher' (4th parameter)
        $stmt->bind_param("ssss", $subject, $day, $time, $teacher);

        if (!$stmt->execute()) {
            echo json_encode(['status' => 'error', 'message' => 'Error inserting data: ' . $stmt->error]);
            exit;
        }
    }

    $stmt->close();
    echo json_encode(['status' => 'success', 'message' => 'Data saved successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No data received!']);
}

$conn->close();
?>