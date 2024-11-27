<?php
include('config.php');
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>My Study KPI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&family=Unbounded:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
      .action { display: none; }
      #cancelButton { display: none; }
    </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col"></div>
      <div class="col text-center logoImage"><img src="images/logo.png" alt="FKI" style="width: 140px; height: 140px;"></div>
      <div class="col">
        <div class="d-flex justify-content-end mt-1">
          <div class="flex-shrink-0 dropdown">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle d-none d-lg-block" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="<?php echo $_SESSION['profile'] ?>" alt="mdo" width="70" height="70" class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small shadow">
              <li><a class="dropdown-item" href="about_me.php">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout_action.php">Sign out</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row nav">
      <div class="col"><?php  include('nav.php'); ?> </div>
    </div>
  </div>

    <main class="container mt-4">
        <?php
        include('config.php');
        session_start();
        $student_id = $_SESSION['user_id'];

        $activities_types = ['activities', 'competition', 'certification'];
        foreach ($activities_types as $activity_type) {
            $sql = "SELECT * FROM Activities WHERE Activity_type = ? AND student_id = ? ORDER BY year, Sem";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $activity_type, $student_id);
            $stmt->execute();
            $result = $stmt->get_result();

            echo "<div class='card mb-5'>";
            echo "<div class='row p-3'>";
            echo "<div class='col'>";
            echo "<h2 class='card-title' ><h1>" . ucfirst($activity_type) . "</h1></h2>";
            echo "<div class='table-responsive'>";

            if ($result->num_rows > 0) {
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr><th>No</th><th>Activity Name</th>";
                if ($activity_type != 'certification') {
                    echo "<th>Activity Level</th>";
                }
                echo "<th>Year</th><th>Sem</th><th>Remark</th><th class='action'>Action</th></tr>";

                $counter = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $counter++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['Activity_name']) . "</td>";
                    if ($activity_type != 'certification') {
                        echo "<td>" . htmlspecialchars($row['Activity_Level']) . "</td>";
                    }
                    echo "<td>" . htmlspecialchars($row['year']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Sem']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Remark']) . "</td>";
                    echo '<td class="action">';
                    echo '<button class="edit-button btn btn-primary btn-sm" data-activities-id="' . $row['Activities_id'] . '">Edit</button>';
                    echo '<button class="delete-button btn btn-danger btn-sm" data-activities-id="' . $row['Activities_id'] . '">Delete</button>';
                    echo "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No data available for " . ucfirst($activity_type) . "</p>";
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>
        <div class="text-center mt-4">
            <button id="insertNewButton" data-bs-toggle="modal" data-bs-target="#insertModal" class="btn btn-primary">Insert New</button>
            <button id="mainButton" class="btn btn-secondary">Edit/Delete</button>
            <button id="cancelButton" class="btn btn-danger">Cancel</button>
        </div>

        <div class="container">
          <footer class="footer d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md d-flex align-items-center">
              <img src="images/logo.png" alt="FKI" style="width: 80px; height: 80px;">
              <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 My Study KPI</span>
            </div>
          </footer>
        </div>

    </main>

    <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Indicator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="" id="activityForm" action="activities_action.php" method="post">

                      <label for="activity_name" class="form-label">Activity Name:</label>
                      <input type="text" id="activity_name" name="activity_name" class="form-control" value="" required><br>

                      <label for="activity_type" class="form-label">Activity Type:</label>
                      <select name="activity_type" id="activity_type" class="form-select">
                          <option value="">--Select--</option>
                          <option value="activities">Activities</option>
                          <option value="competition">Competition</option>
                          <option value="certification">Certification</option>
                      </select><br>

                      <div style="display: block;">
                          <label for="activity_level" id="activityLevelLabel" class="form-label">Activity Level:</label>
                          <select name="activity_level" id="activity_level" class="form-select">
                              <option value="faculty">Faculty</option>
                              <option value="university">University</option>
                              <option value="national">National</option>
                              <option value="international">International</option>
                          </select>
                      </div>

                      <div style="display: block;">
                          <label for="sem" class="form-label">Sem:</label>
                          <select name="sem" id="sem" class="form-select" required>
                              <option value=1>1</option>
                              <option value=2>2</option>
                          </select><br>

                          <label for="year" class="form-label">Year:</label> <!-- Updated label text to "Year" -->
                          <select name="year" id="year" class="form-select" required>
                              <option value=1>1</option>
                              <option value=2>2</option>
                              <option value=3>3</option>
                              <option value=4>4</option>
                          </select><br>
                      </div>

                      <label for="remark" class="form-label">Remark:</label>
                      <textarea id="remark" name="remark" rows="4" cols="50" class="form-control"></textarea><br>

                  </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="activityForm">Save Changes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Indicator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h1>Activities From</h1>

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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="activityForm">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var editButtons = document.querySelectorAll('.edit-button');
        var deleteButtons = document.querySelectorAll('.delete-button');
        var mainButton = document.getElementById('mainButton');
        var cancelButton = document.getElementById('cancelButton');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var activitiesId = this.getAttribute('data-activities-id');
                window.location.href = 'activities_edit.php?activities_id=' + activitiesId;
            });
        });

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var activitiesId = this.getAttribute('data-activities-id');
                window.location.href = 'activities_delete.php?activities_id=' + activitiesId;
            });
        });

        mainButton.addEventListener('click', function() {
            document.querySelectorAll('.action').forEach(function(column) {
                column.style.display = 'table-cell';
            });
            cancelButton.style.display = 'inline';
        });

        cancelButton.addEventListener('click', function() {
            document.querySelectorAll('.action').forEach(function(column) {
                column.style.display = 'none';
            });
            this.style.display = 'none';
        });

        // Get references to the Activity Type and Activity Level elements
        const activityTypeSelect = document.getElementById("activity_type");
        const activityLevelLabel = document.getElementById("activityLevelLabel");
        const activityLevelSelect = document.getElementById("activity_level");
        const activityForm = document.getElementById("activityForm");

        // Initially, hide the Activity Level field
        activityLevelLabel.style.display = "none";
        activityLevelSelect.style.display = "none";

        // Add an event listener to the Activity Type dropdown
        activityTypeSelect.addEventListener("change", function () {
            if (activityTypeSelect.value === "activities" || activityTypeSelect.value === "competition") {
                console.log("Show the Activity Level field");
                activityLevelLabel.style.display = "inline";
                activityLevelSelect.style.display = "inline";
            } else {
                console.log("Hide the Activity Level field");
                activityLevelLabel.style.display = "none";
                activityLevelSelect.style.display = "none";
            }
        });

        // Add an event listener for form submission
        activityForm.addEventListener("submit", function (event) {
            // Check if Activity Type is "--Select--"
            if (activityTypeSelect.value === "") {
                alert("Please select an Activity Type.");
                event.preventDefault(); // Prevent form submission
            }

            // Check if Activity Name is empty
            const activityNameInput = document.getElementById("activity_name");
            if (activityNameInput.value.trim() === "") {
                alert("Please enter an Activity Name.");
                event.preventDefault(); // Prevent form submission
            }
        });

    </script>
</body>
</html>
