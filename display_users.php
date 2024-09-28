<?php
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

// Fetch all users from the database
$sql = "SELECT id, name, email, dob, gender, created_at FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
</head>

<body>
    <div class="container mt-5">

        <div>
            <h2 class="text-center">Registered Users</h2>
            <!-- Go to Form Button -->
            <a href="index.php" class="btn btn-primary">Go to Form</a>
        </div>


        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Registered At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['dob']); ?></td>
                            <td><?php echo htmlspecialchars($row['gender']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">No registered users found.</p>
        <?php endif; ?>
    </div>

    <?php $conn->close(); ?>
</body>

</html>