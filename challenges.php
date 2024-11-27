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
<style>
  .action { display: none; }
  #cancelButton { display: none; }
</style>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col"></div>
      <div class="col text-center logoImage"><img src="images/logo.png" alt="FKI" style="width: 140px; height: 140px;"></div>
      <div class="col">
        <div class="d-flex justify-content-end mt-1">
          <div class="flex-shrink-0 dropdown">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle d-none d-lg-block" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="<?php echo $_SESSION['profile'] ; ?>" alt="mdo" width="70" height="70" class="rounded-circle">
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
      <div class="row">
        <div class="col">
        <div class="card">
        <div class="card-body">
        <h1>Challenges</h1>

        <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#challengesModal">Add New Challenge</button>


        <?php
        $student_id = $_SESSION['user_id']; // assuming you have the student's ID in session

        $sql = "SELECT * FROM Challenges WHERE student_id = ? ORDER BY sem, year";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-bordered table-hover'>";
            echo "<thead><tr>
                    <th>No</th>
                    <th>Year</th>
                    <th>Sem</th>
                    <th>Challenges</th>
                    <th>Future Plan</th>
                    <th>Remarks</th>
                    <th class='action'>Action</th>
                  </tr></thead><tbody>";

                $count = 1;
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>" . $count . "</td>
                          <td>" . htmlspecialchars($row['year']) . "</td>
                          <td>" . htmlspecialchars($row['sem']) . "</td>
                          <td>" . htmlspecialchars($row['challenge_description']) . "</td>
                          <td>" . htmlspecialchars($row['future_plan']) . "</td>
                          <td>" . htmlspecialchars($row['remarks']) . "</td>";
                          echo '<td class="action">';
                          echo '<button class="btn btn-primary btn-sm m-2 edit-button" data-bs-toggle="modal" data-bs-target="#editChallengeModal" data-id="' . $row['id'] . '" data-year="' . $row['year'] . '" data-sem="' . $row['sem'] . '" data-des="' . htmlspecialchars($row['challenge_description']) . '" data-plan="' . htmlspecialchars($row['future_plan']) . '" data-remark="' . htmlspecialchars($row['remarks']) . '">Edit</button>';
                          echo '<button class="delete-button btn btn-danger btn-sm" data-challenges-id="' . $row['id'] . '">Delete</button>';
                          echo '</td></tr>';

                  $count++;
                }
                echo "</tbody></table></div>";
            } else {
                echo "<p>No challenges found.</p>";
            }
            ?>
          </div>
    </div>
</div>
<div class="row mt-2">
  <div class="col-4">
    <button id="mainButton" class="btn btn-secondary">Edit/Delete</button>
    <button id="cancelButton" class="btn btn-danger">Cancel</button>
  </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="challengesModal" tabindex="-1" aria-labelledby="challengesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="challengesModalLabel1">Add/Edit Challenge</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="challengeForm" action="insert_challenges_action.php" method="post">
                <div class="mb-3">
                    <label for="challenge_description" class="form-label">Challenges:</label>
                    <textarea id="challenge_description1" name="challenge_description" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="future_plan" class="form-label">Future Plan:</label>
                    <textarea id="future_plan1" name="future_plan" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="sem" class="form-label">Sem:</label>
                    <select name="sem" id="sem1" class="form-select" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="year" class="form-label">Year:</label>
                    <select name="year" id="year1" class="form-select" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="remark" class="form-label">Remark:</label>
                    <textarea id="remark1" name="remark" class="form-control" rows="4"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="challengeForm">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editChallengeModal" tabindex="-1" aria-labelledby="editChallengeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="challengesModalLabel">Edit Challenge</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="challenges_edit_action.php" method="post" id="editForm">

                  <div class="mb-3">
                      <label for="id" class="form-label" hidden>Challenges ID:</label>
                      <input type="text" id="id" name="id" class="form-control" hidden>
                  </div>

                  <div class="mb-3">
                      <label for="challenge_description" class="form-label">Challenges:</label>
                      <textarea id="challenge_description" name="challenge_description" rows="4" class="form-control"></textarea>
                  </div>

                  <div class="mb-3">
                      <label for="future_plan" class="form-label">Future Plan:</label>
                      <textarea id="future_plan" name="future_plan" rows="4" class="form-control"></textarea>
                  </div>

                  <div class="mb-3">
                      <label for="sem" class="form-label">Sem:</label>
                      <select name="sem" id="sem" class="form-select">
                          <option>1</option>
                          <option>2</option>
                      </select>
                  </div>

                  <div class="mb-3">
                      <label for="year" class="form-label">Year:</label>
                      <select name="year" id="year" class="form-select">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                      </select>
                  </div>

                  <div class="mb-3">
                      <label for="remark" class="form-label">Remark:</label>
                      <textarea id="remark" name="remark" rows="4" class="form-control"></textarea>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="editForm">Save Changes</button>
            </div>
        </div>
    </div>
</div>
</main>
<div class="container">
  <footer class="footer d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md d-flex align-items-center">
      <img src="images/logo.png" alt="FKI" style="width: 80px; height: 80px;">
      <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 My Study KPI</span>
    </div>
  </footer>
</div>

    <script>
    var eeditChallengeModal = document.getElementById('editChallengeModal');
    editChallengeModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var year = button.getAttribute('data-year');
        var sem = button.getAttribute('data-sem');
        var des = button.getAttribute('data-des');
        var plan = button.getAttribute('data-plan');
        var remark = button.getAttribute('data-remark');

        document.getElementById('id').value = id;
        document.getElementById('challenge_description').value = des;
        document.getElementById('future_plan').value = plan;
        document.getElementById('sem').value = sem;
        document.getElementById('year').value = year;
        document.getElementById('remark').value = remark;
    });

    // Add an event listener to all "Edit" buttons with the class 'edit-button'
    var deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        // Get the Activities_id from the 'data-activities-id' attribute
        var activitiesId = this.getAttribute('data-challenges-id');

        // Construct the URL for the edit page with the Activities_id as a parameter
        var editPageUrl = 'challenges_delete.php?challenges_id=' + activitiesId;

        // Redirect to the edit page
        window.location.href = editPageUrl;
      });
    });


    // Function to show edit buttons and columns
    function showEditButtons() {
      var actionColumns = document.querySelectorAll('.action');
      actionColumns.forEach(function(column) {
        column.style.display = 'table-cell'; // Show the column
      });
      var cancelButton = document.getElementById('cancelButton');
      cancelButton.style.display = 'inline';
    }

    // Function to hide edit buttons and columns
    function hideEditButtons() {
      var actionColumns = document.querySelectorAll('.action');
      actionColumns.forEach(function(column) {
        column.style.display = 'none'; // Hide the column
      });
      var cancelButton = document.getElementById('cancelButton');
      cancelButton.style.display = 'none';
    }

    // Add an event listener to the Main Button to show edit buttons
    var mainButton = document.getElementById('mainButton');
    mainButton.addEventListener('click', showEditButtons);

    // Add an event listener to the Cancel Button to hide edit buttons
    var cancelButton = document.getElementById('cancelButton');
    cancelButton.addEventListener('click', hideEditButtons);

    </script>
</body>
</html>
