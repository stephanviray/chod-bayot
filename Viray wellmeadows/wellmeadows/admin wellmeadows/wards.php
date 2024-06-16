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
}

// SQL query to fetch ward data
$sql = "SELECT ward_num, ward_name, location, total_number_of_bed, telephone_extension_num FROM Ward";
$result = pg_query($conn, $sql);

// Array to store ward data
$wards = array();

// Check if there are results
if ($result) {
    // Output data of each row
    while ($row = pg_fetch_assoc($result)) {
        $wards[] = $row;
    }
} else {
    echo "Error: " . pg_last_error($conn);
}

// Close connection
pg_close($conn);

// Return ward data as JSON
echo json_encode($wards);
?>
