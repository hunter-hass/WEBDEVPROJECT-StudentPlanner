

<?php
require_once('./initialize.php');
include("session_handling.php");
ensure_logged_in();
$userName = $_SESSION["userName"];

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
    <title>Share Notes</title>
</head>

<body>
    <div class="wrapper">
    <?php if ($_SESSION["type"] != "admin") {
            include "headnavbar.php";
        } else {
            include "headnavbaradmin.php";
        }
        ?>

        <!-- table to share notes -->
        <div class="notes-box-row-share">
            <div class="notes-box">
                <span class="notes-span">ALL NOTES</span>
                </p>
                <table class="fixed-table">
                    <thead>
                        <?php
                        display_notes_table_share(get_all_notes());
                        ?>
                    </thead>
                </table>
            </div>
        </div>
        <?php include "footer.php"; ?>
        <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fwebdev.cs.uwosh.edu%2Fstudents%2Fhassh70%2Fproject%2Fsharenotes.php" referrerpolicy="unsafe-url">
            Validate My HTML
        </a>
        <?php $uri = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
        <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?= $uri ?>" referrerpolicy="unsafe-url" target="_blank">css val</a>
    </div>

</body>

</html>