<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" >
    <meta name="author" content="Hunter Hass">
    <link rel="stylesheet" href="styleSheet.css">
    <title>Home</title>
</head>

<body>
    <?php require_once('./initialize.php');
    include("session_handling.php");
    ensure_logged_in();
    ?>
    <?php if (isset($_SESSION["flash"])) { ?>
        <p><?= $_SESSION["flash"] ?></p>
    <?php unset($_SESSION["flash"]);
    } ?>
    <div class="wrapper">
        <?php if ($_SESSION["type"] != "admin") {
            include "headnavbar.php";
        } else {
            include "headnavbaradmin.php";
        }
        ?>

        <div id="top-bar">
            <p id="intro">Welcome to your Magic Planner. Here you will find your tasks for this week and your recent notes.</p>
        </div>

        <div class="content">
            <!-- Get weekly tasks -->
            <div id="home-boxes">
                <div id="side-tasks">
                    <h3>This weeks Tasks:</h3>
                    <table class="fixed-table">
                        <thead>
                            <?php
                            display_tasks_table_home(get_tasks_weekly());
                            ?>
                        </thead>
                    </table>
                <!-- Get all notes -->
                </div>
                <div id="notes-div">
                    <h2>Recent Notes:</h2>
                    <div id="notes-container-home">
                        <?php
                        display_notes_cards(get_notes());
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <p>
    </p>
        <?php include "footer.php"; ?>
        <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fwebdev.cs.uwosh.edu%2Fstudents%2Fhassh70%2Fproject%2Fhome.php" referrerpolicy="unsafe-url">
            Validate My HTML
        </a>
        <?php $uri = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
        <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?= $uri ?>" referrerpolicy="unsafe-url" target="_blank">css val</a>
    </div>
</body>

</html>