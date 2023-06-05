<?php
// Replace with your database connection details
$servername = "localhost";
$username = "adanmw_user";
$password = "adan@mw123";
$dbname = "adanmw_dt";

// Establish a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the "attendance" table
$sql = "SELECT student_name, student_id, attendance_status FROM attendance";
$result = $conn->query($sql);

// Prepare the data in an array
$data = array();
$columnNames = array("Student Name", "Student ID", "Attendance Status"); // Column names

if ($result->num_rows > 0) {
     // Add column names to the data array
     $data[] = $columnNames;

     while ($row = $result->fetch_assoc()) {
         $data[] = array_values($row);
     }
}

// Close the database connection
$conn->close();

// Send the data as JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
