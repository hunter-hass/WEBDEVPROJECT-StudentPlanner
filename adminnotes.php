<?php
require_once('./initialize.php');
include("session_handling.php");
ensure_logged_in();
ensure_admin();
$userName = $_SESSION["userName"];

// Test user input
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="Hunter Hass">
    <link rel="stylesheet" href="styleSheet.css">
    <script src="scripts.js"></script>
    <title>Adminnotes</title>
</head>

<body>

    <form action="adminnotes.php" id="deleteNote" method="post" hidden>
        <!-- <button class="button" onclick="">Remove Task</button> -->
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Delete note
        if (isset($_POST["deleteNote"])) {
            if (isset($_POST["notes"]) && strpos($_POST["notes"], 'D') !== false) {
                $note = get_note(substr($_POST["notes"], 0, -1));
                delete_note($_POST["notes"]);
                unlink("/var/www/students/hassh70/project/uploads/" . $note['File_Location']);
            }
        } elseif (isset($_POST["editbutton"])) {//edit note and get note to edit
            if (isset($_POST["notes"]) && strpos($_POST["notes"], 'U') !== false) {
                $note = get_note(substr($_POST["notes"], 0, -1));
            }
        } elseif (isset($_POST["editNote"])) {
            if (isset($_POST["note_name"]) && strlen($_POST['note_name'])) {
                if (isset($_POST["summary"]) && strlen($_POST['summary'])) {
                    update_note($_POST["note_name"], $_POST["summary"], $_POST["class"],  $_POST["id"]);
                }
            }
        }
    }

    if (isset($_SESSION["flash"])) { ?>
        <p><?= $_SESSION["flash"] ?></p>
    <?php unset($_SESSION["flash"]);
    } ?>

    <!-- Form for edit a note -->
    <div class="form-popup-note" id="myFormNoteEdit">
        <form action="adminnotes.php" class="form-container" method="post">
            <div>
                <input type="hidden" name="id" value="<?= $note['Id'] ?>">
                <label for="note_name">Note Name:</label>
                <input type="text" name="note_name" id="note_name" size="80" value="<?= $note['Note_Name'] ?>" required>
            </div>
            <div>
                <label for="summary">Summary:</label>
                <input type="text" name="summary" id="summary" size="80" value="<?= $note['Summary'] ?>" required>
            </div>
            <div>
                <label for="class">Class:</label>
                <input type="text" name="class" id="class" size="80" value="<?= $note['class'] ?>">
            </div>

            <div class="pop-form-buttons">
                <input type="submit" value="Confirm" name="editNote">
                <button type="button" class="btn cancel" onclick="closeEditFormNote()">Cancel</button>
            </div>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["notes"]) && isset($_POST["editbutton"])) {
            if (strpos($_POST["notes"], 'U') !== false) {
    ?>
                <script type="text/javascript" language="JavaScript">
                    openEditFormNote();
                </script>
    <?php
            }
        }
    }
    ?>

    <div class="wrapper">
        <?php if ($_SESSION["type"] != "admin") {
            include "headnavbar.php";
        } else {
            include "headnavbaradmin.php";
        }
        ?>
        <!-- Div to view notes -->
        <div id="top-bar">
            <p id="intro">Here you will be able view all the notes.</p>
        </div>
        <div class="planner-content">
            <div id="plannerButtons">
                <button class="button" form="deleteNote" type="submit" name="editbutton">Edit Task</button>
                <button form="deleteNote" type="submit" class="button" name="deleteNote">Remove Note</button>
            </div>

            <div class="notes-box-row">
                <div class="notes-box">
                    <span class="notes-span">ALL NOTES</span>
                    </p>
                    <table class="fixed-table">
                        <thead>
                            <?php
                            display_notes_table_admin(get_all_notes());
                            ?>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
        <?php include "footer.php"; ?>
        <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fwebdev.cs.uwosh.edu%2Fstudents%2Fhassh70%2Fproject%2Fadminnotes.php" referrerpolicy="unsafe-url">
            Validate My HTML
        </a>
        <?php $uri = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
        <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?= $uri ?>" referrerpolicy="unsafe-url" target="_blank">css val</a>
    </div>



</body>

</html>