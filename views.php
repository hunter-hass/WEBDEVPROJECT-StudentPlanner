<?php
// View for tasks tables
function display_tasks_table($tasks)
{ ?>
  <tr>
    <th>Title</th>
    <th>Task</th>
    <th>Edit Task</th>
    <th>Delete</th>
  </tr>
  <?php foreach ($tasks as $task) { ?>
    <tr>
      <td class="task-name-td" ><?= $task['Task_Title'] ?></td>
      <td><?= $task['task'] ?></a></td>
      <td><label form="deleteForm"><input form="deleteForm" type="radio" name="tasks" value=<?= $task['id'] . "U" ?>></label></td>
      <td><label form="deleteForm"><input form="deleteForm" type="radio" name="tasks" value=<?= $task['id'] . "D" ?>></label></td>
    </tr>
  <?php } ?>

<?php
}


// admin task table
function display_tasks_table_admin($tasks)
{ ?>
  <tr>
    <th>Title</th>
    <th>Task</th>
    <th>Owner</th>
    <th>Edit Task</th>
    <th>Delete</th>
  </tr>
  <?php foreach ($tasks as $task) { ?>
    <tr>
      <td class="task-name-td" ><?= $task['Task_Title'] ?></td>
      <td><?= $task['task'] ?></a></td>
      <td class="username-wrap"><?= $task['User_idd'] ?></a></td>
      <td><label form="deleteForm"><input form="deleteForm" type="radio" name="tasks" value=<?= $task['id'] . "U" ?>></label></td>
      <td><label form="deleteForm"><input form="deleteForm" type="radio" name="tasks" value=<?= $task['id'] . "D" ?>></label></td>
    </tr>
  <?php } ?>

<?php
}

// Get tasks for home
function display_tasks_table_home($tasks)
{ ?>
  <tr>
    <th>Title</th>
    <th>Task</th>
  </tr>
  <?php foreach ($tasks as $task) { ?>
    <tr>
      <td class="task-name-td" ><?= $task['Task_Title'] ?></td>
      <td><?= $task['task'] ?></a></td>
    </tr>
  <?php } ?>

<?php
}





// Display notes table
function display_notes_table($notes)
{ ?>
  <tr>
    <th>Note Name</th>
    <th>Class</th>
    <th>Summary</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
  <?php foreach ($notes as $notes) { ?>
    <tr>
      <td><a class="note-name-td"href="https://webdev.cs.uwosh.edu/students/hassh70/project/uploads/<?= $notes['File_Location'] ?>"><?= $notes['Note_Name'] ?></td>
      <td><?= $notes['class'] ?></td>
      <td><?= $notes['Summary'] ?></td>
      <td><label form="deleteNote"><input type="radio" form="deleteNote" name="notes" value=<?= $notes['Id'] . "U" ?>></label></td>
      <td><label form="deleteNote"><input type="radio" form="deleteNote" name="notes" value=<?= $notes['Id']  . "D" ?>></label></td>
    </tr>
  <?php } ?>

<?php
}

// display notes admin
function display_notes_table_admin($notes)
{ ?>
  <tr>
    <th>Note Name</th>
    <th>Class</th>
    <th>Summary</th>
    <th>Owner</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
  <?php foreach ($notes as $notes) { ?>
    <tr>
      <td><a class="note-name-td"href="https://webdev.cs.uwosh.edu/students/hassh70/project/uploads/<?= $notes['File_Location'] ?>"><?= $notes['Note_Name'] ?></td>
      <td><?= $notes['class'] ?></td>
      <td><?= $notes['Summary'] ?></td>
      <td><?= $notes['user_idd'] ?></td>
      <td><label form="deleteNote"><input type="radio" form="deleteNote" name="notes" value=<?= $notes['Id'] . "U" ?>></label></td>
      <td><label form="deleteNote"><input type="radio" form="deleteNote" name="notes" value=<?= $notes['Id']  . "D" ?>></label></td>
    </tr>
  <?php } ?>

<?php
}

// Display notes to share
function display_notes_table_share($notes)
{ ?>
  <tr>
    <th>Note Name</th>
    <th>Class</th>
    <th>Summary</th>
  </tr>
  <?php foreach ($notes as $notes) { ?>
    <tr>
      <td><a class="note-name-td"href="https://webdev.cs.uwosh.edu/students/hassh70/project/uploads/<?= $notes['File_Location'] ?>"><?= $notes['Note_Name'] ?></td>
      <td><?= $notes['class'] ?></td>
      <td><?= $notes['Summary'] ?></td>
    </tr>
  <?php } ?>

<?php
}


// display cards on home page of notes.
function display_notes_cards($notes)
{ ?>
  <?php foreach ($notes as $notes) { ?>
    <div class="box">
      <p class="title-cards"><a href="https://webdev.cs.uwosh.edu/students/hassh70/project/uploads/<?= $notes['File_Location'] ?>"><?= $notes['Note_Name'] ?></a></p>
      <p> <b> Class:</b> <?= $notes['class'] ?></p>
      <p> <b> Description:</b> <?= $notes['Summary'] ?></p>
  </div>
  <?php } ?>

<?php
}

?>