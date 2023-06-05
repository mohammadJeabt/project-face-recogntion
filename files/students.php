<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    $image = $_POST['image'];

    // Connect to MySQL database
    $host = "localhost"; // Database host
    $user = "adanmw_user"; // Database username
    $password = "adan@mw123"; // Database password
    $database = "adanmw_dt"; // Database name
    $conn = mysqli_connect($host, $user, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Save image to server
    $img_dir = 'uploads/';
    $img_name = $id . '.png'; // Or use any other extension like .jpg, .jpeg, etc.
    $img_path = $img_dir . $img_name;
    $img_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));
    file_put_contents($img_path, $img_data);

    // Save data to database
    $sql = "INSERT INTO students_table (name_st, id_st, email_st, image_st) VALUES ('$name', '$id', '$email', '$img_path')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    header('Location: thanks.html');

}
?>