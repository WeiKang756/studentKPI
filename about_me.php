<?php
include('config.php');
session_start();

$student_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id); // Assuming 'student_id' is a string; adjust the type if needed
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc(); // Assuming one user per 'student_id'
$_SESSION['profile'] =  $user['profile_image_path'];
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
                <img src="<?php echo $user['profile_image_path']; ?>" alt="mdo" width="70" height="70" class="rounded-circle">
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
<main>

  <div class="container mt-5">
    <div class="row text-center">
      <h4><?php echo $user['student_name'];?></h4>
    </div>
    <div class="row">

      <div class="col-lg-4 order-3 order-lg-1">
          <h2>My Study Motto<h2>
            <h6 class="U-text"><?php echo $user["study_motto"] ?></h6>
            </article>
      </div>


        <div class="col-lg-4 text-center order-1 order-lg-2">
          <!-- Replace 'photo.jpg' with the actual path to your image file -->
          <img src="<?php echo $user['profile_image_path']; ?>" alt="My Photo" class="rounded-circle img-fluid" width="300" height="300">
        </div>

        <div class="col-lg-4 d-flex flex-column order-2 order-lg-3">
          <div class="row">
            <div class="col text-center">
              <h3>Personal information</h3>
            </div>

          </div>

          <div class="d-flex align-self-center flex-grow-1">
            <table class="table table-hover">
              <tr>
                <td>Name: </td>
                <td> <?php echo $user['student_name']; ?></td>
              </tr>

              <tr>
                <td>Matric No: </td>
                <td><?php echo $user['student_id']; ?></td>
              </tr>

              <tr>
                <td>Program: </td>
                <td><?php echo $user['program']; ?></td>
              </tr>

              <tr>
                <td>Email: </td>
                <td><?php echo $user['email']; ?></td>
              </tr>

              <tr>
                <td>Intake Batch: </td>
                <td><?php echo $user['intake_batch']; ?></td>
              </tr>

              <tr>
                <td>Mentor Name: </td>
                <td><?php echo $user['mentor_name']; ?></td>
              </tr>

              <tr>
                <td>State of Origin: </td>
                <td><?php echo $user['state_of_origin']; ?></td>
              </tr>

            </table>
            </div>
          </div>
      </div>
  <div class="row">
    <div class="col-lg-6">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeImage">Change Profile</button>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#study_motto">Change Motto</button>
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


<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="edit_action.php" method="post">
          <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['student_name']); ?>">
          </div>

          <div class="mb-3">
            <label for="student_id" class="form-label">Matric No:</label>
            <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo htmlspecialchars($user['student_id']); ?>" disabled>
          </div>

          <div class="mb-3">
            <label for="program" class="form-label">Program:</label>
            <input type="text" class="form-control" id="program" name="program" value="<?php echo htmlspecialchars($user['program']); ?>">
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
          </div>

          <div class="mb-3">
            <label for="intake_batch" class="form-label">Intake Batch:</label>
            <input type="text" class="form-control" id="intake_batch" name="intake_batch" value="<?php echo htmlspecialchars($user['intake_batch']); ?>" oninput="validateIntakeBatch(this)">
          </div>

          <div class="mb-3">
            <label for="mentor_name" class="form-label">Mentor Name:</label>
            <input type="text" class="form-control" id="mentor_name" name="mentor_name" value="<?php echo htmlspecialchars($user['mentor_name']); ?>">
          </div>

          <div class="mb-3">
            <label for="state_of_origin" class="form-label">State of Origin:</label>
            <input type="text" class="form-control" id="state_of_origin" name="state_of_origin" value="<?php echo htmlspecialchars($user['state_of_origin']); ?>">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="changeImage" tabindex="-1" aria-labelledby="changeImageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changeImageModalLabel">Change Profile Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="changeProfileForm" id="changeProfileForm" action="edit_photo.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="inputGroupFile04" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="profilePicture" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" form="changeProfileForm">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="study_motto" tabindex="-1" aria-labelledby="changeStudyModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changeStudyModalLabel">Change Motto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="study_motto_form" action="study_motto.php" method="post">
          <div class="mb-3">
            <textarea name="study_motto" class="form-control" rows="8" cols="80" required></textarea>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" form="study_motto_form">Save Changes</button>
      </div>
    </div>
  </div>
</div>


</body>
<script>
    var changeProfileForm = document.querySelector('.changeProfileForm');

      document.getElementById('changeProfileForm').addEventListener('submit', function(event) {
      var fileInput = document.getElementById('inputGroupFile04');
      if(fileInput.value === '') {
          alert('Please select a file to upload.');
          event.preventDefault(); // Prevents the form from being submitted
      }
  });

  function validateIntakeBatch(inputElement) {
      var regex = /^\d{4}\/\d{4}$/; // Regular expression for "yyyy/yyyy" format
      if (!regex.test(inputElement.value)) {
          // 如果格式不正确，显示错误消息
          inputElement.setCustomValidity("Invalid format. Use 'yyyy/yyyy' format (e.g., 2021/2022).");
      } else {
          // 如果格式正确，清除错误消息
          inputElement.setCustomValidity("");
      }
  }

</script>
</html>
