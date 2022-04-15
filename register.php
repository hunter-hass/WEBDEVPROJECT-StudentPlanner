<?php
include("session_handling.php");
require_once('./initialize.php');
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //checking if valid inputs
  if (isset($_POST["firstName"]) && strlen($_POST['firstName'])) {
    if (isset($_POST["lastName"]) && strlen($_POST['lastName'])) {
      if (isset($_POST["school"]) && strlen($_POST['school'])) {
        if (isset($_POST["email"]) && strlen($_POST['email'])) {
          if (isset($_POST["userName"]) && strlen($_POST['userName'])) {
            if (isset($_POST["password"]) && strlen($_POST['password'])) {
              if (strlen($_POST['password']) >= 5) {
                $firstName = $_POST["firstName"];
                $lastName = $_POST["lastName"];
                $school = $_POST["school"];
                $email = $_POST["email"];
                $userName = $_POST["userName"];
                $password = $_POST["password"];

                if (register(test_input($firstName), test_input($lastName), test_input($email), test_input($school), test_input($userName), test_input($password))) {
                  redirect("login.php", "Registration succeeded. You may now log in.");
                }
              } else {
?>
                <p>Password must be at least 5 characters.</p>

            <?php
              }
            } else {
              ?>
                <p>Password must not be empty.</p>

            <?php
              
            }
          }
        }
      }
    }
  } else {
    ?>
    <script>
      alert("Please Enter your credentials correctly.")
    </script>
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
  <meta name="author" content="Hunter Hass">
  <meta name="robots" content="noindex, nofollow" >
  <link rel="stylesheet" href="styleSheet.css">
  <title>Register</title>
</head>

<body>
  <!-- Form for register with images -->
  <div id="register-wrapper">
  <img class="all_images" id="register-image_1" src="images/cluttered.jpg" alt="Cluttered Notes">
  <img class="all_images" id="register-image_2" src="images/journal.jpg" alt="Cluttered Notes">
    <div class="register-login-wrapper">
      <div class="center-login">
        <form class="login-form" method="POST">
          <h1>Welcome to Magic Planner</h1>
          <div class="info">
            <div class="register-input">
              <label for="firstName">First Name</label>
              <input type="text" name="firstName" id="firstName" placeholder="First Name" required>
            </div>
            <div class="register-input">
              <label for="lastName">Last Name</label>
              <input type="text" name="lastName" id="lastName" placeholder="Last Name" required>
            </div>
            <div class="register-input">
              <label for="school">School</label>
              <input type="text" name="school" id="school" placeholder="School" required>
            </div>
            <div class="register-input">
              <label for="email">Email</label>
              <input type="text" name="email" id="email" placeholder="email" required>
            </div>
            <div class="register-input">
              <label for="userName">User Name</label>
              <input type="text" name="userName" id="userName" placeholder="User Name" required>
            </div>
            <div class="register-input">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" placeholder="password" required>
            </div>

          </div>
          <div id="login-button-div">
            <button id="resetbutton" type="reset">Reset Fields</button>
            <button type="submit">Register</button>
          </div>
        </form>
      </div>
    </div>
    <?php include "footer.php"; ?>
    <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fwebdev.cs.uwosh.edu%2Fstudents%2Fhassh70%2Fproject%2Fregister.php" referrerpolicy="unsafe-url">
            Validate My HTML
        </a>
        <?php $uri = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
        <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?= $uri ?>" referrerpolicy="unsafe-url" target="_blank">css val</a>
  </div>
</body>

</html>