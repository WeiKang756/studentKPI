<?php
include("config.php");

function studentIdExists($studentId, $conn) {
    $stmt = $conn->prepare("SELECT student_id FROM users WHERE student_id = ?");
    $stmt->bind_param("s", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}


function initializeSemesterRecords($studentId, $conn) {
    $totalYears = 4;
    $semestersPerYear = 2;

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO Indicators(student_id, sem, year) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    for ($year = 1; $year <= $totalYears; $year++) {
        for ($sem = 1; $sem <= $semestersPerYear; $sem++) {
            $stmt->bind_param("sii", $studentId, $sem, $year);
            if (!$stmt->execute()) {
                // Handle execution error
                echo "Error executing statement: " . $stmt->error;
            }
        }
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentName = mysqli_real_escape_string($conn, $_POST['student_name']);
    $studentId = mysqli_real_escape_string($conn, $_POST['student_id']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPwd = mysqli_real_escape_string($conn, $_POST['confirmPwd']);
    $target_dir = "uploads/";
    $target_file = $target_dir . 'image.png';

    if ($password !== $confirmPwd) {
        echo '<script>alert("Password and confirm password do not match."); window.location.href = "index.php";</script>';
        exit();
    }

    if (studentIdExists($studentId, $conn)) {
        echo '<script>alert("Student ID already exists"); window.location.href = "index.php";</script>';
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (student_name, student_id, password, profile_image_path,program) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $studentName, $studentId, $hashedPassword, $target_file, $program);

    if ($stmt->execute()) {
        initializeSemesterRecords($studentId, $conn);
        echo '<script>alert("New user record created successfully. Welcome ' . $studentName . '"); window.location.href = "index.php";</script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

mysqli_close($conn);
?>
