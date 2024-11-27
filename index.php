<!DOCTYPE html>
<html lang="en" dir="ltr">
<style media="screen">
.index_header{
  background-color: black;
  padding-top: 10px;
}

</style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>My Study KPI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-11">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-5">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="images/logo.png"
                    style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">My Study KPI</h4>
                </div>

        <form action="login_action.php" method="post" id="login">
                  <p>Please login to your account</p>

                  <div class="form-outline mb-4">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" id="floatingInput" name="student_id" placeholder="Student ID" required>
                        <label for="floatingInput">Student ID</label>
                    </div>
                  </div>

                  <div class="form-outline mb-4">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" id="floatingPassword" name="password" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                  </div>
                  </form>

                  <div class="text-center pt-1 mb-5 pb-1">
                      <button type="submit" class="btn btn-primary w-100" type="submit" form="login">Sign In</button>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#registerModal">Create One</button>

                  </div>

                </form>

              </div>
            </div>
            <div class="col-lg-7 mt-2 d-none d-lg-block">
                <img src="images/banner.jpeg" alt="FKI" style="width: 750px; height: 750px;" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  </main>

  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel">Register Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="registerForm" action="register_action.php" method="post">
          <div class="container mt-4">
                <form action="register_action.php" method="post">

                    <div class="mb-3">
                        <label for="student_name" class="form-label">Student Name:</label>
                        <input type="text" class="form-control" id="student_name" name="student_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="student_id" class="form-label">Student ID:</label>
                        <input type="text" class="form-control" id="student_id" name="student_id" required>
                    </div>

                    <div class="mb-3">
                        <label for="program" class="form-label">Program:</label>
                        <input type="text" class="form-control" id="program" name="program" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirmPwd" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirmPwd" name="confirmPwd" required>
                    </div>
                </form>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="registerForm">Register</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
