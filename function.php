<?php

function getCountOfActivities($conn, $Activity_type, $Activity_Level, $Sem, $year, $student_id) {
    $sql = "SELECT COUNT(*) as activity_count FROM `Activities` WHERE Activity_type = ? AND Activity_Level = ? AND Sem = ? AND year = ? AND student_id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssiis", $Activity_type, $Activity_Level, $Sem, $year, $student_id);

    $stmt->execute(); // Execute the statement
    $result = $stmt->get_result();
    $row = $result->fetch_assoc(); // Fetch the result
    $activityCount = $row['activity_count']; // Get the activity count

    return $activityCount; // Return the count or 0 if no records are found
}

function getCountOfCertification($conn, $Activity_type, $Sem, $year, $student_id) {
    $sql = "SELECT COUNT(*) as activity_count FROM `Activities` WHERE Activity_type = ? AND Sem = ? AND year = ? AND student_id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("siis", $Activity_type, $Sem, $year, $student_id);

    $stmt->execute(); // Execute the statement
    $result = $stmt->get_result();
    $row = $result->fetch_assoc(); // Fetch the result
    $activityCount = $row['activity_count']; // Get the activity count

    return $activityCount; // Return the count or 0 if no records are found
}

function getLeadership($conn, $student_id, $year, $sem) {
    $sql = "SELECT Leadership FROM Indicators WHERE student_id = ? AND year = ? AND sem = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $student_id, $year, $sem);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row['Leadership'];
    } else {
        return "not insert"; // Or appropriate default value
    }
}

function Graduate_Aim($conn, $student_id, $year, $sem) {
    $sql = "SELECT Graduate_Aim FROM Indicators WHERE student_id = ? AND year = ? AND sem = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $student_id, $year, $sem);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row['Graduate_Aim'];
    } else {
        return "not insert"; // Or appropriate default value
    }
}

function getCGPA($conn, $student_id, $year, $sem) {
    $sql = "SELECT CGP FROM Indicators WHERE student_id = ? AND year = ? AND sem = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $student_id, $year, $sem);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return $row['CGP'];
    } else {
        return "not insert"; // Or appropriate default value
    }
}

function updateKPI($conn, $student_id, $year, $Sem, $activitiesFL, $activitiesUL, $activitiesNL, $activitiesIL, $competitionFL, $competitionUL, $competitionNL, $competitionIL, $certification) {
    $sql = "UPDATE Indicators SET Activities_FL = ?, Activities_UL = ?, Activities_NL = ?, Activities_IL = ?, Competition_FL = ?, Competition_UL = ?, Competition_NL = ?, Competition_IL = ?, Professional_Certification = ? WHERE student_id = ? AND year = ? AND sem = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiiiiiiisii", $activitiesFL, $activitiesUL, $activitiesNL, $activitiesIL, $competitionFL, $competitionUL, $competitionNL, $competitionIL, $certification, $student_id, $year, $Sem);
    $stmt->execute();
    $stmt->close();
}
?>
