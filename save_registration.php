<?php
 error_reporting( E_ALL );
 ini_set( "display_errors", 1 );
 
// Database connection credentials
$servername = "localhost"; // Change if your database is hosted elsewhere
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "registration";  // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

    // SQL query to insert the data into the users table
    $sql = "INSERT INTO users (name, email, dob, gender, password) VALUES ('$name', '$email', '$dob', '$gender', '$password')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        header("Location: display_users.php"); // Redirect to the user data page
        exit(); // Stop further script execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
