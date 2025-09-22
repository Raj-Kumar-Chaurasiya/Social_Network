<?php
// Check if the form was submitted with the 'submit' button
    if (isset($_POST['submit'])) {

    // Get the username (email) and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to the database
    $adc = mysqli_connect("localhost", "root", "", "webkool");

    // Check for a successful database connection
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch the hashed password from the database
    $sql = "SELECT name, dob, image_name, password FROM mypage WHERE email = ?";
    $stmt = $adc->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the given email was found
    if ($result->num_rows > 0) {
        // Fetch the user's data as an associative array
        $user = $result->fetch_assoc();
        $stored_hashed_password = $user['password'];

        // Use password_verify() to check the plain text password against the stored hash
        if (password_verify($password, $stored_hashed_password)) {
            // Password matches, so fetch all the user details to display
            $name = htmlspecialchars($user['name']);
            $dob = htmlspecialchars($user['dob']);
            $photo_name = htmlspecialchars($user['image_name']);
            $photo_path = 'uploads/' . $photo_name;
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>User Profile</title>
            </head>
            <body bgcolor='lightblue' align="center">
                <h1>Welcome, <?php echo $name; ?>!</h1>
                <br>
                <table align="center" border="1" cellpadding="10" cellspacing="0" bgcolor="#f0f8ff" width="400">
                    <tr>
                        <td colspan="2" align="center">
                            <?php if (!empty($photo_name) && file_exists($photo_path)): ?>
                                <img src="<?php echo $photo_path; ?>" alt="Profile Photo" width="150" height="150">
                            <?php else: ?>
                                <p>No profile photo found.</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Full Name:</strong></td>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Date of Birth:</strong></td>
                        <td><?php echo $dob; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email Address:</strong></td>
                        <td><?php echo htmlspecialchars($username); ?></td>
                    </tr>
                </table>
            </body>
            </html>
            <?php
        } else {
            // If password does not match
            echo "<h1 align='center'><font color='red'>Invalid password.</font></h1>";
        }
    } else {
        // If no user found with that email
        echo "<h1 align='center'><font color='red'>Email ID not found.</font></h1>";
    }

    // Close the statement and the database connection
    $stmt->close();
    $adc->close();
}
?>