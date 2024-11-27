<?php
include("config.php");
session_start();

$student_id = $_SESSION['user_id'];
$sem = mysqli_real_escape_string($conn, $_POST['sem']);
$year = mysqli_real_escape_string($conn, $_POST['year']);
$cgp = mysqli_real_escape_string($conn, $_POST['cgp']);
$leadership = mysqli_real_escape_string($conn, $_POST['leadership']);
$graduate_aim = mysqli_real_escape_string($conn, $_POST['graduate_aim']);

$sql = "UPDATE Indicators
        SET CGP = ?, Leadership = ?, Graduate_Aim = ?
        WHERE student_id = ? AND sem = ? AND year = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

$stmt->bind_param("ssssii", $cgp, $leadership, $graduate_aim, $student_id, $sem, $year);

if ($stmt->execute()) {
    echo '<script>alert("Record Successful"); window.location.href = "kpi_indicator_form.php";</script>';
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
mysqli_close($conn);
?>
