<?php
// Set the active page based on the current page
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <!-- The navigation bar starts here -->
  <div class="container-fluid">
    <!-- Container for the navigation bar content -->
    <a class="navbar-brand navKPI" href="#">
      STUDY KPI
    </a>
    <!-- Brand/logo on the left side of the navbar -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Hamburger menu button for smaller screens -->
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <!-- Navigation links and menu for smaller screens -->
      <div class="navbar-nav">
        <!-- Individual navigation links with "active" class based on the current page -->
        <a class="nav-link <?php echo ($current_page == 'about_me.php') ? 'active' : ''; ?>" href="about_me.php">Profile</a>
        <a class="nav-link <?php echo ($current_page == 'list_of_activities.php') ? 'active' : ''; ?>" href="list_of_activities.php">List of Activities</a>
        <a class="nav-link <?php echo ($current_page == 'kpi_indicator_form.php') ? 'active' : ''; ?>" href="kpi_indicator_form.php">KPI Indicator</a>
        <a class="nav-link <?php echo ($current_page == 'challenges.php') ? 'active' : ''; ?>" href="challenges.php">Challenges</a>
      </div>
      <div class="ms-auto">
        <a href="logout_action.php" class="btn btn-warning" style="text-decoration: none; color: black;">Logout</a>
      </div>
    </div>
  </div>
</nav>
