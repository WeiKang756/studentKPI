<?php
include('config.php');
session_start();

$student_id = $_SESSION['user_id'];
$sem = $_GET['sem'];
$year = $_GET['year'];

$stmt = $conn->prepare("SELECT CGP, Leadership, Graduate_Aim FROM your_table_name WHERE student_id = ? AND sem = ? AND year = ?");
$stmt->bind_param("sii", $student_id, $sem, $year);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();
if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(['CGP' => '', 'Leadership' => '', 'Graduate_Aim' => '']);
}

$stmt->close();
mysqli_close($conn);
?>
