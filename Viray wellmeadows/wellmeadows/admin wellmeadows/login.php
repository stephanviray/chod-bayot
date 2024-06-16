<?php
session_start();
$host = "localhost";
$port = "5432";
$dbname = "wellmeadows";
$user = "postgres";
$password = "143546";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
} else {
    echo "Connected successfully";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists in the database
    $check_user_sql = "SELECT id, email, password FROM users WHERE email = $1";
    $check_user_result = pg_query_params($conn, $check_user_sql, array($email));

    if (pg_num_rows($check_user_result) == 1) {
        // User exists, verify password
        $user_row = pg_fetch_assoc($check_user_result);
        if ($password === $user_row['password']) { // Direct password comparison (not recommended for production)
            // Password is correct, set session variables and redirect
            $_SESSION['user_id'] = $user_row['id'];
            header("Location: index.html");
            exit();
        } else {
            // Incorrect password, display alert message
            echo "<script>alert('Incorrect email or password.'); window.history.back();</script>";
            exit();
        }
    } else {
        // User does not exist, display alert message
        echo "<script>alert('Incorrect email or password.'); window.history.back();</script>";
        exit();
    }
}

pg_close($conn);
?>
