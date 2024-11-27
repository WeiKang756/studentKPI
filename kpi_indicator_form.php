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
              <img src="<?php echo $_SESSION['profile']; ?>" alt="mdo" width="70" height="70" class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small shadow">
              <li><a class="dropdown-item" href="#">Profile</a></li>
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
        <h1>KPI Indicator Form</h1>
        <?php
        include('config.php');
        include('function.php');
        session_start();
        $student_id = $_SESSION['user_id'];

        for ($year = 1; $year <= 4; $year++){
            echo "<div class='row'>";
            for ($Sem = 1; $Sem <= 2; $Sem++) {
              echo "<div class='col-lg-6'>";
                // Fetching data from the database
                $activitiesFL  = getCountOfActivities($conn, 'activities', 'faculty', $Sem, $year, $student_id);
                $activitiesUL = getCountOfActivities($conn, 'activities', 'university', $Sem, $year, $student_id);
                $activitiesNL = getCountOfActivities($conn, 'activities', 'national', $Sem, $year, $student_id);
                $activitiesIL = getCountOfActivities($conn, 'activities', 'international', $Sem, $year, $student_id);
                $competitionFL = getCountOfActivities($conn, 'competition', 'faculty', $Sem, $year, $student_id);
                $competitionUL = getCountOfActivities($conn, 'competition', 'university', $Sem, $year, $student_id);
                $competitionNL = getCountOfActivities($conn, 'competition', 'national', $Sem, $year, $student_id);
                $competitionIL = getCountOfActivities($conn, 'competition', 'international', $Sem, $year, $student_id);
                $certification = getCountOfCertification($conn, 'certification', $Sem, $year, $student_id);
                $cgp = getCGPA($conn, $student_id, $year, $Sem);
                $leadership = getLeadership($conn, $student_id, $year, $Sem);
                $Graduate_Aim = Graduate_Aim($conn, $student_id, $year, $Sem);

                updateKPI($conn, $student_id, $year, $Sem, $activitiesFL, $activitiesUL, $activitiesNL, $activitiesIL, $competitionFL, $competitionUL, $competitionNL, $competitionIL, $certification);

                // Card for each semester
                echo "<div class='trigger cardIndicator'>";
                echo "<div class='card mb-3'>";
                echo "<div class='card-header'>Year $year - Sem $Sem</div>";
                echo "<div class='card-body'>";
                echo "<table class='table table-hover'>";
                echo "<tr><th>Category</th><th>Value</th></tr>";
                echo "<tr><td>CGP</td><td>" . htmlspecialchars($cgp) . "</td></tr>";
                echo "<tr><td>Leadership</td><td>" . htmlspecialchars($leadership) . "</td></tr>";
                echo "<tr><td>Graduate Aim</td><td>" . htmlspecialchars($Graduate_Aim) . "</td></tr>";
                echo "<tr><td>Faculty Level Activities</td><td>" . htmlspecialchars($activitiesFL) . "</td></tr>";
                echo "<tr><td>University Level Activities</td><td>" . htmlspecialchars($activitiesUL) . "</td></tr>";
                echo "<tr><td>National Level Activities</td><td>" . htmlspecialchars($activitiesNL) . "</td></tr>";
                echo "<tr><td>International Level Activities</td><td>" . htmlspecialchars($activitiesIL) . "</td></tr>";
                echo "<tr><td>Faculty Level Competitions</td><td>" . htmlspecialchars($competitionFL) . "</td></tr>";
                echo "<tr><td>University Level Competitions</td><td>" . htmlspecialchars($competitionUL) . "</td></tr>";
                echo "<tr><td>National Level Competitions</td><td>" . htmlspecialchars($competitionNL) . "</td></tr>";
                echo "<tr><td>International Level Competitions</td><td>" . htmlspecialchars($competitionIL) . "</td></tr>";
                echo "<tr><td>Certifications</td><td>" . htmlspecialchars($certification) . "</td></tr>";
                echo "</table>";
                echo '<button data-bs-toggle="modal" data-bs-target="#editModal" data-sem="' . $Sem . '" data-year="' . $year . '" data-cgp="' . $cgp . '" data-leadership="' . $leadership . '" data-graduate_aim="' . $Graduate_Aim . '" class="btn btn-primary">Edit</button>';

                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }echo "</div>";
        }
        ?>

    </main>
    <div class="container">
      <footer class="footer d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md d-flex align-items-center">
          <img src="images/logo.png" alt="FKI" style="width: 80px; height: 80px;">
          <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 My Study KPI</span>
        </div>
      </footer>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Indicator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="indicator_action.php" method="post" class="needs-validation" novalidate>
                        <!-- Semester -->
                        <div class="mb-3">
                            <label for="semModal" class="form-label" hidden>Sem:</label>
                            <select name="sem" id="semModal" class="form-select" required hidden>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                            <div class="invalid-feedback">Please select a semester.</div>
                        </div>

                        <!-- Year -->
                        <div class="mb-3">
                            <label for="yearModal" class="form-label" hidden></label>
                            <select name="year" id="yearModal" class="form-select" required hidden>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <div class="invalid-feedback">Please select a year.</div>
                        </div>

                        <!-- CGPA -->
                        <div class="mb-3">
                            <label for="cgpModal" class="form-label">CGPA:</label>
                            <input type="number" step="0.01" min="0" max="4" id="cgpModal" name="cgp" class="form-control" placeholder="CGP" required>
                            <div class="invalid-feedback">Please enter a valid CGPA.</div>
                        </div>

                        <!-- Leadership -->
                        <div class="mb-3">
                            <label for="leadershipModal" class="form-label">Leadership:</label>
                            <input type="number" id="leadershipModal" name="leadership" class="form-control" min="0" required>
                            <div class="invalid-feedback">Please enter a valid leadership value.</div>
                        </div>

                        <!-- Graduate Aim -->
                        <div class="mb-3">
                            <label for="graduateAimModal" class="form-label">Graduate Aim:</label>
                            <select name="graduate_aim" id="graduateAimModal" class="form-select" required>
                                <option value="On Time">On Time</option>
                                <option value="Postpone">Postpone</option>
                            </select>
                            <div class="invalid-feedback">Please select a graduate aim.</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="editForm">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script>

    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var sem = button.getAttribute('data-sem');
        var year = button.getAttribute('data-year');
        var cgp = button.getAttribute('data-cgp');
        var leadership = button.getAttribute('data-leadership');
        var graduateAim = button.getAttribute('data-graduate_aim');

        document.getElementById('semModal').value = sem;
        document.getElementById('yearModal').value = year;
        document.getElementById('cgpModal').value = cgp;
        document.getElementById('leadershipModal').value = leadership;
        document.getElementById('graduateAimModal').value = graduateAim;
    });

    // Add form submission validation
    var editForm = document.getElementById('editForm');
    editForm.addEventListener('submit', function (event) {
        // Check if required fields are empty
        var cgpInput = document.getElementById('cgpModal');
        var leadershipInput = document.getElementById('leadershipModal');
        var graduateAimSelect = document.getElementById('graduateAimModal');

        if (cgpInput.value === '' || leadershipInput.value === '' || graduateAimSelect.value === '') {
            // Prevent form submission and display an alert
            event.preventDefault();
            alert('Please fill in all required fields.');
        }
    });
</script>
</html>
