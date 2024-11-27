<?php
include('config.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web">
    <title>Edit Profile</title>
  </head>
  <body>
    <?php
    $student_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_id); // Assuming 'student_id' is a string; adjust the type if needed
    $stmt->execute();
    $result = $stmt->get_result();

    $user = $result->fetch_assoc(); // Assuming one user per 'student_id'
    ?>

    <h1>Edit Profile</h1>
    <form class="" action="edit_action.php" method="post">

    <label for="name:">Name: </label>
    <input type="text" id="name" name="name" value= "<?php echo $user['student_name'];?>"><br>

    <label for="student_id">Matric No :</label>
    <input type="text" id="student_id" name="student_id" value= "<?php echo $user['student_id'];?>" disabled><br>

    <label for="program">Program :</label>
    <input type="text" id="program" name="program" value= "<?php echo $user['program'];?>"><br>

    <label for="email">Email :</label>
    <input type="text" id="email" name="email" value= "<?php echo $user['email'];?>"><br>

    <label for="intake_batch">Intake Batch :</label>
    <input type="text" id="intake_batch" name="intake_batch" value="<?php echo $user['intake_batch']; ?>" oninput="validateIntakeBatch(this.value);">
    <span id="intake_batch_error" style="color: red;"></span><br>

    <label for="mentor_name">Mentor Name :</label>
    <input type="text" id="mentor_name" name="mentor_name" value= "<?php echo $user['mentor_name'];?>"><br>

    <label for="state_of_origin">State of Origin :</label>
    <input type="text" id="state_of_origin" name="state_of_origin" value= "<?php echo $user['state_of_origin'];?>"><br>

    <button type="submit" style="display:inline;">Save</button>
    </form>
    <button id="cancelButton">Cancel</button>
    </body>
    <script>

    function validateIntakeBatch(input) {
        var regex = /^\d{4}\/\d{4}$/; // Regular expression for "yyyy/yyyy" format

        if (regex.test(input)) {
            document.getElementById("intake_batch_error").textContent = "";
        } else {
            document.getElementById("intake_batch_error").textContent = "Invalid format. Use 'yyyy/yyyy' format (e.g., 2021/2022).";
        }

        console.log("Input: " + input); // Add this line for debugging
    }


    var cancelButton = document.getElementById('cancelButton');
    cancelButton.addEventListener('click', function() {
        var aboutMeUrl = 'about_me.php';
        window.location.href =  aboutMeUrl;
    });

    </script>
</html>
