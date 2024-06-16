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
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if email already exists in the database
    $check_email_sql = "SELECT id FROM users WHERE email = $1";
    $check_email_result = pg_query_params($conn, $check_email_sql, array($email));

    if (pg_num_rows($check_email_result) > 0) {
        // Email already exists, display alert message
        echo "<script>alert('Email address already exists.'); window.history.back();</script>";
        exit();
    }

    // Check if passwords match
    if ($password != $confirm_password) {
        // Passwords do not match, display alert message
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit();
    }

    // Insert new user into database
    $insert_sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ($1, $2, $3, $4)";
    $result = pg_query_params($conn, $insert_sql, array($first_name, $last_name, $email, $password));

    if ($result) {
        // Registration successful, display alert message and redirect to login page
        echo "<script>alert('Registration successful.'); window.location.href = 'login.html';</script>";
        exit();
    } else {
        echo "Error: " . pg_last_error($conn);
    }
}

pg_close($conn);
?>
