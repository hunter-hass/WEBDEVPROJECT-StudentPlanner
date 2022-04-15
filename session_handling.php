<?php
session_start();

# Redirects current page to login.php if user is not logged in.
function ensure_logged_in()
{
  if (!isset($_SESSION["userName"])) {
    redirect("login.php", "You must log in before you can view that page.");
  }
}


function ensure_admin()
{
  if ($_SESSION["type"] != "admin") {
    redirect("login.php", "You must be an admin to view this page.");
  }
}

# Redirects current page to the given URL and optionally sets flash message.
function redirect($url, $flash_message = NULL)
{
  if ($flash_message) {
    $_SESSION["flash"] = $flash_message;
  }

  header("Location: $url");
  die;
}


function logout()
{
  session_destroy();
  session_regenerate_id(TRUE);
  session_start();
  redirect("login.php", "Logout successful.");
}
