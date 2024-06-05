<?php
include 'Database.php';
include 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['matric'])) {
        $matric = $_GET['matric'];

        $database = new Database();
        $db = $database->getConnection();

        $user = new User($db);
        $userDetails = $user->getUser($matric);
        $db = null;
    } else {
        echo "Matric number is missing.";
        exit;
    }
} else {
    echo "Invalid request method.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>

<body>
    <form action="update.php" method="post">
        <input type="hidden" name="matric" value="<?php echo $userDetails['matric']; ?>"><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $userDetails['name']; ?>"><br>
        <br><label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="">Please select</option>
            <option value="Lecturer" <?php if ($userDetails['role'] == 'Lecturer') echo "selected"; ?>>Lecturer</option>
            <option value="Student" <?php if ($userDetails['role'] == 'Student') echo "selected"; ?>>Student</option>
        </select><br>
        <br><input type="submit" value="Update"><a href="read.php">Cancel</a>
    </form>
</body>

</html>
