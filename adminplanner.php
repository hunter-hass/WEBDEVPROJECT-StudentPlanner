<?php

//validate user inputs
function test_input($data) {
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
    <meta name="robots" content="noindex, nofollow" >
    <meta name="author" content="Hunter Hass">
    <link rel="stylesheet" href="styleSheet.css">
    <script src="scripts.js"></script>
    <title>adminplanner</title>
</head>


<body>
    <form action="adminplanner.php" id="deleteForm" method="post" hidden>
        <!-- <button class="button" onclick="">Remove Task</button> -->
    </form>
    <?php
    require_once('./initialize.php');
    include("session_handling.php");
    ensure_logged_in();
    ensure_admin();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           //add task
        if (isset($_POST["addtask"])) {
            if (isset($_POST["task-title"]) && strlen($_POST['task-title'])) {
                if (isset($_POST["task"]) && strlen($_POST['task'])) {
                    insert_task(test_input($_POST['task']), test_input($_POST['task-title']));
                    redirect("adminplanner.php", "Task has been uploaded.");
                } else {
    ?>
                    <script>
                        alert("Please enter a task.")
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    alert("Please enter a task title")
                </script>
    <?php
            }
        } elseif (isset($_POST["editbutton"])) {
            if (isset($_POST["tasks"]) && strpos($_POST["tasks"], 'U') !== false) {
                $task = get_task(substr($_POST["tasks"], 0, -1));
            }
        } elseif (isset($_POST["edittask"])) {
            if (isset($_POST["task_title"]) && strlen($_POST['task_title'])) {
                if (isset($_POST["task"]) && strlen($_POST['task'])) {
                    update_task($_POST["task"], $_POST["task_title"], $_POST["id"]);
                }
            }
        } elseif (isset($_POST["deletebutton"])) {
            if (isset($_POST["tasks"]) && strpos($_POST["tasks"], 'D') !== false) {
                delete_task(substr($_POST["tasks"], 0, -1));
            }
        }
    }
    unset($_POST['value']);
    ?>
<!--  Form to edit -->
    <div class="form-popup" id="myEditForm">
        <form action="adminplanner.php" class="form-container" method="post">
            <input type="hidden" name="id" value="<?= $task['id'] ?>">
            <div>
                <label for="task_title">Task Title:</label>
                <input type="text" name="task_title" id="task_title" size="80" value="<?= $task['Task_Title'] ?>" required>
            </div>
            <div>
                <label for="task">Task:</label>
                <input class="form-input" type="text" name="task" id="task" size="80" value="<?= $task['task'] ?>" required>
            </div>
            <div class="pop-form-buttons">
                <input type="submit" value="Submit" name="edittask">
                <button type="button" class="btn cancel" onclick="closeEditForm()">Cancel</button>
            </div>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["tasks"]) && isset($_POST["editbutton"])) {
            if (strpos($_POST["tasks"], 'U') !== false) {
    ?>
                <script type="text/javascript" language="JavaScript">
                    openEditForm();
                </script>
    <?php
            }
        }
    }

    if (isset($_SESSION["flash"])) { ?>
        <p><?= $_SESSION["flash"] ?></p>
    <?php unset($_SESSION["flash"]);
    } 
    ?>


    <div class="wrapper">
    <?php if ($_SESSION["type"] != "admin") {
            include "headnavbar.php";
        } else {
            include "headnavbaradmin.php";
        }
        ?>
        <div id="top-bar">
            <p id="intro">Here you can view all tasks entered.</p>
        </div>
        <div class="planner-content">
            <div id="plannerButtons">
                <button class="button" form="deleteForm" type="submit" name="editbutton">Edit Task</button>
                <button form="deleteForm" type="submit" class="button" name="deletebutton">Remove Task</button>
            </div>

            <div class="planner-side">
                <div class="plannerbox-admin">
                    <span>All Tasks</span>
                    <table class="fixed-table">
                        <thead>
                            <?php
                            display_tasks_table_admin(get_tasks_all());
                            ?>
                        </thead>
                    </table>
                </div>


        </div>
        <?php include "footer.php"; ?>
        <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fwebdev.cs.uwosh.edu%2Fstudents%2Fhassh70%2Fproject%2Fadminplanner.php" referrerpolicy="unsafe-url">
            Validate My HTML
        </a>
        <?php $uri = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
        <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?= $uri ?>" referrerpolicy="unsafe-url" target="_blank">css val</a>
    </a>
    </div>
</body>

</html>