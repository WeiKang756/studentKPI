<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Activity</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-fluid">
        <!-- Your navigation and header code here -->
    </div>

    <main class="container mt-4">
        <?php
        include('config.php');
        session_start();
        $Activities_id = $_GET['activities_id'];
        $_SESSION['activities_id'] = $Activities_id;
        $sql = 'SELECT * FROM Activities WHERE Activities_id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $Activities_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);
        ?>

        <h1>Edit Form</h1>
        <form id="activityForm" action="activities_edit_action.php" method="post">
            <div class="mb-3">
                <label for="activity_name" class="form-label">Activity Name:</label>
                <input type="text" class="form-control" id="activity_name" name="activity_name" value="<?php echo $row['Activity_name']; ?>">
            </div>

            <div class="mb-3">
                <label for="activity_type" class="form-label">Activity Type:</label>
                <select name="activity_type" id="activity_type" class="form-select">
                    <option value="activities" <?php if ($row['Activity_type'] == 'activities') echo 'selected'; ?>>Activities</option>
                    <option value="competition" <?php if ($row['Activity_type'] == 'competition') echo 'selected'; ?>>Competition</option>
                    <option value="certification" <?php if ($row['Activity_type'] == 'certification') echo 'selected'; ?>>Certification</option>
                </select>
            </div>

            <div class="mb-3" id="activityLevelDiv">
                <label for="activity_level" class="form-label">Activity Level:</label>
                <select name="activity_level" id="activity_level" class="form-select">
                    <option value="faculty" <?php if ($row['Activity_Level'] == 'faculty') echo 'selected'; ?>>Faculty</option>
                    <option value="university" <?php if ($row['Activity_Level'] == 'university') echo 'selected'; ?>>University</option>
                    <option value="national" <?php if ($row['Activity_Level'] == 'national') echo 'selected'; ?>>National</option>
                    <option value="international" <?php if ($row['Activity_Level'] == 'international') echo 'selected'; ?>>International</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="sem" class="form-label">Semester:</label>
                <select name="sem" id="sem" class="form-select">
                    <option value="1" <?php if ($row['Sem'] == '1') echo 'selected'; ?>>1</option>
                    <option value="2" <?php if ($row['Sem'] == '2') echo 'selected'; ?>>2</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Year:</label>
                <select name="year" id="year" class="form-select">
                    <option value="1" <?php if ($row['year'] == '1') echo 'selected'; ?>>1</option>
                    <option value="2" <?php if ($row['year'] == '2') echo 'selected'; ?>>2</option>
                    <option value="3" <?php if ($row['year'] == '3') echo 'selected'; ?>>3</option>
                    <option value="4" <?php if ($row['year'] == '4') echo 'selected'; ?>>4</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="remark" class="form-label">Remark:</label>
                <textarea id="remark" name="remark" class="form-control" rows="4"><?php echo $row['Remark']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="list_of_activities.php" class="btn btn-secondary">Cancel</a>
        </form>
    </main>

    <script>
        const activityTypeSelect = document.getElementById("activity_type");
        const activityLevelDiv = document.getElementById("activityLevelDiv");

        activityTypeSelect.addEventListener("change", function () {
            if (activityTypeSelect.value === "activities" || activityTypeSelect.value === "competition") {
                activityLevelDiv.style.display = "block";
            } else {
                activityLevelDiv.style.display = "none";
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            if (activityTypeSelect.value !== "activities" && activityTypeSelect.value !== "competition") {
                activityLevelDiv.style.display = "none";
            }
        });
    </script>
</body>
</html>
