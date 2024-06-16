<?php
session_start();
$host = "localhost";
$port = "5432";
$dbname = "wellmeadow";
$user = "postgres";
$password = "143546";

// Create connection string
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Get form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$sex = $_POST['sex'];
$hoursPerWeek = $_POST['hoursPerWeek'];
$salaryPaymentType = $_POST['salaryPaymentType'];
$wardName = $_POST['wardName'];
$dob = $_POST['dob'];
$phone = $_POST['phone'];
$nin = $_POST['nin'];
$position = $_POST['position'];
$currentSalary = $_POST['currentSalary'];
$salaryScale = $_POST['salaryScale'];
$qualificationType = $_POST['qualificationType'];
$dateOfQualification = $_POST['dateOfQualification'];
$institutionName = $_POST['institutionName'];
$positionExp = $_POST['positionExp'];
$startDateExp = $_POST['startDateExp'];
$finishDateExp = $_POST['finishDateExp'];
$orgNameExp = $_POST['orgNameExp'];

// Insert data into Staff table
$sql = "INSERT INTO Staff (first_name, last_name, address, sex, hours_per_week, type_of_salary_payment, ward_name, date_of_birth, tel_no, national_insurance_num, position_held, current_salary, salary_scale, qualification_id, work_experience_id)
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, NULL, NULL)";
$params = array($firstName, $lastName, $address, $sex, $hoursPerWeek, $salaryPaymentType, $wardName, $dob, $phone, $nin, $position, $currentSalary, $salaryScale);
$result = pg_query_params($conn, $sql, $params);

if ($result) {
    $staff_id = pg_last_oid($result);

    // Insert data into Qualifications table
    $sql_qualifications = "INSERT INTO Qualifications (type, date_of_qualification, institution_name)
                           VALUES ($1, $2, $3) RETURNING qualification_id";
    $params_qualifications = array($qualificationType, $dateOfQualification, $institutionName);
    $result_qualifications = pg_query_params($conn, $sql_qualifications, $params_qualifications);
    $qualification_id = pg_fetch_result($result_qualifications, 0, 'qualification_id');

    // Insert data into Work_Experience table
    $sql_experience = "INSERT INTO Work_Experience (position, start_date, finish_date, organization_name)
                       VALUES ($1, $2, $3, $4) RETURNING work_experience_id";
    $params_experience = array($positionExp, $startDateExp, $finishDateExp, $orgNameExp);
    $result_experience = pg_query_params($conn, $sql_experience, $params_experience);
    $work_experience_id = pg_fetch_result($result_experience, 0, 'work_experience_id');

    // Update Staff table with qualification_id and work_experience_id
    $sql_update_staff = "UPDATE Staff SET qualification_id = $1, work_experience_id = $2 WHERE staff_num = $3";
    $params_update_staff = array($qualification_id, $work_experience_id, $staff_id);
    pg_query_params($conn, $sql_update_staff, $params_update_staff);

    header("Location: staffs.html"); // Redirect to staffs.html after successful addition
    exit();
} else {
    echo "Error: " . pg_last_error($conn);
}

pg_close($conn);
?>
