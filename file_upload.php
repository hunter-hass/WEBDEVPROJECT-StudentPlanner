<?php
require_once('./initialize.php');
include("session_handling.php");
ensure_logged_in();
function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $upload_dir = "uploads";
   if ($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK && !(empty($_FILES["fileToUpload"]["tmp_name"]))) {
      if (isset($_POST["note-name"]) && strlen($_POST['note-name'])) {
         if (isset($_POST["class"]) && strlen($_POST['class'])) {
            if (isset($_POST["summary"]) && strlen($_POST['summary'])) {
               $tmp_name = $_FILES["fileToUpload"]["tmp_name"];

               // Ignore any path information in the filename
               $name = basename($_FILES["fileToUpload"]["name"]);
               $name = rand() . $name;

               // Move the temp file and give it a new name 
               move_uploaded_file($tmp_name, "$upload_dir/$name");
?>
            <?php
               insert_note(test_input($name), test_input($_POST["note-name"]), test_input($_POST["summary"]), test_input($_POST["class"]));
               redirect("notes.php", "Note has been uploaded.");
            } else {
               redirect("notes.php", "Note can't be uploaded, missing summary");
            }
         } else {
            redirect("notes.php", "Note can't be uploaded, missing class");
         }
      } else {
         redirect("notes.php", "Note can't be uploaded, missing name");
      }

            ?>
   <?php
   } else {
   ?>
      <?php
      redirect("notes.php", "Note can't be uploaded"); ?>
<?php }
}
?>