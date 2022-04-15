<?php
require_once('./initialize.php');
include("session_handling.php");

$loginFailed = FALSE;
if ($_SERVER["REQUEST_METHOD"] == "POST") {


  if (isset($_POST["userName"]) && strlen($_POST['userName'])) {
    if (isset($_POST["password"]) && strlen($_POST['password'])) {
      $userName = $_POST["userName"];
      $password = $_POST["password"];
      if (is_password_correct($userName, $password)) {
        $user = get_user($userName);

        $_SESSION["userName"] = $userName;     # start session, remember user info
        $_SESSION["type"] = $user["type"];
        redirect("home.php", "Login successful! Welcome back.");
      } else {
?>
        <p>Incorrect password.</p>
      <?php
      }
    } else {
      $name = "";
      $password = "";
      ?>
      <p>Please enter a password.</p>

    <?php
    }
  } else {
    $name = "";
    $password = "";
    ?>
    <p>Please enter a user name.</p>
<?php
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styleSheet.css">
  <meta name="author" content="Hunter Hass">
  <script src="scripts.js"></script>
  <title>Login</title>
</head>

<body>
  <?php if (isset($_SESSION["flash"])) { ?>
    <p><?= $_SESSION["flash"] ?></p>
  <?php unset($_SESSION["flash"]);
  } ?>
  <div class="login-wrapper">
    <img class="all_images" id="login-image_1" src="images/man-taking-notes.jpg" alt="Note Man">
    <img class="all_images" id ="login-image_2" src="images/writing-notes.jpg" alt="Note Man">
    <div class="center-login">
      <form class="login-form" method="POST">
        <h1>Welcome to Magic Planner</h1>
        <div class="info">

          <!-- three text fields -->
          <label class="login-label" for="userName">UserName:</label>
          <input type="text" name="userName" id="userName" placeholder="User Name" required>
          <label class="login-label" for="password">Password:</label>
          <input type="password" name="password" id="password" placeholder="password" required>

        </div>
        <div id="login-button-div">
          <button id="resetbutton" type="reset">Reset Fields</button>
          <button type="submit">Login</button>
          <button type="button" onclick="window.location.href='http://webdev.cs.uwosh.edu/students/hassh70/project/register.php';">
            Create Account
          </button>
        </div>
      </form>
    </div>
    <?php include "footer.php"; ?>
    <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fwebdev.cs.uwosh.edu%2Fstudents%2Fhassh70%2Fproject%2Flogin.php" referrerpolicy="unsafe-url">
      Validate My HTML
    </a>
    <?php $uri = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
    <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?= $uri ?>" referrerpolicy="unsafe-url" target="_blank">css val</a>
  </div>

</body>

</html>