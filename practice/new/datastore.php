<?php

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
    
    $upload_dir = 'uploads/';
    
    $photo_name = basename($_FILES['photo']['name']);
    
    $target_file = $upload_dir . $photo_name;
    
    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        $photo_name = '';
    }
} else {
    $photo_name = '';
}

$name = $_POST['name'];
$date = $_POST['dob'];
$id = $_POST['email'];
// Encrypt the password using password_hash() before storing
$pass_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);

$adc = mysqli_connect("localhost", "root", "", "webkool");

if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO mypage (name, dob, email, password, image_name) VALUES (?, ?, ?, ?, ?)";

$p = $adc->prepare($sql);
// Use the hashed password in the prepared statement
$p->bind_param("sssss", $name, $date, $id, $pass_hashed, $photo_name);

if ($p->execute()) {
    header("Location: medium.php");
    exit;
} else {
    echo "Error: " . $p->error;
}

$p->close();
$adc->close();

?>