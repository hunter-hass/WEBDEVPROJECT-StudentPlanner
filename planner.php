<?php

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
    <meta name="robots" content="noindex, nofollow" >
    <meta name="author" content="Hunter Hass">
    <link rel="stylesheet" href="styleSheet.css">
    <script src="scripts.js"></script>
    <title>Planner</title>
</head>


<body>
    <form action="planner.php" id="deleteForm" method="post" hidden>
        <!-- <button class="button" onclick="">Remove Task</button> -->
    </form>
    <?php
    require_once('./initialize.php');
    include("session_handling.php");
    ensure_logged_in();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Add task
        if (isset($_POST["addtask"])) {
            if (isset($_POST["task-title"]) && strlen($_POST['task-title'])) { //check if title entered
                if (isset($_POST["task"]) && strlen($_POST['task'])) { //Check if task entered
                    insert_task(test_input($_POST['task']), test_input($_POST['task-title']));
                    redirect("planner.php", "Task has been uploaded.");
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
            } // check if edit was selected
        } elseif (isset($_POST["editbutton"])) {
            if (isset($_POST["tasks"]) && strpos($_POST["tasks"], 'U') !== false) {
                $task = get_task(substr($_POST["tasks"], 0, -1)); // get task
            }
        } elseif (isset($_POST["edittask"])) {
            if (isset($_POST["task_title"]) && strlen($_POST['task_title'])) {
                if (isset($_POST["task"]) && strlen($_POST['task'])) {
                    update_task($_POST["task"], $_POST["task_title"], $_POST["id"]);
                    redirect("planner.php", "Task has been updated.");
                }
            }
        } elseif (isset($_POST["deletebutton"])) { // delete task
            if (isset($_POST["tasks"]) && strpos($_POST["tasks"], 'D') !== false) {
                delete_task(substr($_POST["tasks"], 0, -1));
                redirect("planner.php", "Task has been deleted.");
            }
        }
    }
    unset($_POST['value']);
    ?>
    <!-- edit form for tasks -->
    <div class="form-popup" id="myEditForm">
        <form action="planner.php" class="form-container" method="post">
            <input type="hidden" name="id" value="<?= $task['id'] ?>">
            <div>
                <label for="task_title">Task Title:</label>
                <input type="text" name="task_title" id="task_title" size="80" value="<?= $task['Task_Title'] ?>" required>
            </div>
            <div>
                <label for="task">Task:</label>
                <input class="form-input" type="text" name="task" id="task" size="80" value="<?= $task['task']?>" required>
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
    <!-- Form to add a task -->
    <div class="form-popup" id="myForm">
        <form action="planner.php" class="form-container" method="post">
            <div>
                <label for="task-title">Task Title:</label>
                <input type="text" name="task-title" id="task-title" size="80" required>
            </div>
            <div>
                <label for="task">Task:</label>
                <input class="form-input" type="text" name="task" id="task" size="80" required>
            </div>
            <div class="pop-form-buttons">
                <input type="submit" value="Confirm" name="addtask">
                <button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
            </div>
        </form>
    </div>

    <div class="wrapper">
        <?php if ($_SESSION["type"] != "admin") {
            include "headnavbar.php";
        } else {
            include "headnavbaradmin.php";
        }
        ?>
        <div id="top-bar">
            <p id="intro">Welcome to your Planner. Here you will today's, this week's, and this month's tasks for you.</p>
        </div>
        <div class="planner-content">
            <div id="plannerButtons">
                <button class="button" onclick="openForm()">Add Task</button>
                <button class="button" form="deleteForm" type="submit" name="editbutton">Edit Task</button>
                <button form="deleteForm" type="submit" class="button" name="deletebutton">Remove Task</button>
            </div>

            <div class="planner-side">
                <div class="plannerbox" id="planner_1">
                    <span>Today</span>
                    <table class="fixed-table">
                        <thead>
                            <?php
                            display_tasks_table(get_tasks()); //Get daily tasks
                            ?>
                        </thead>
                    </table>
                </div>

                <div class="plannerbox" id="planner_2">
                    <span>This Week</span>
                    <table class="fixed-table">
                        <thead>
                            <?php
                            display_tasks_table(get_tasks_weekly()); // get weekly tasks
                            ?>
                        </thead>
                    </table>
                </div>

                <div class="plannerbox" >
                    <span>This Month</span>
                    <table class="fixed-table">
                        <thead>
                            <?php
                            display_tasks_table(get_tasks_monthly()); // get monthly tasks
                            db_disconnect();
                            ?>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
        <?php include "footer.php"; ?>
        <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fwebdev.cs.uwosh.edu%2Fstudents%2Fhassh70%2Fproject%2Fplanner.php" referrerpolicy="unsafe-url">
            Validate My HTML
        </a>
        <?php $uri = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>
        <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?= $uri ?>" referrerpolicy="unsafe-url" target="_blank">css val</a>
    </div>
</body>

</html>