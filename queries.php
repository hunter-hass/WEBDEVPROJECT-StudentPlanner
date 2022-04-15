<?php

// Insert task
function insert_task($task, $task_title) {
  global $db;

  try {
    $query = "INSERT INTO tasks(Task_Title,task, User_idd) VALUES (?,?,?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$task_title,$task, $_SESSION["userName"]]);
    return $db->lastInsertId();
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was a database error when inserting a new book.");
  }
}

// Delete task
function delete_task($id) {
  global $db;

  try {
    $query = "DELETE FROM tasks WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    return $db->lastInsertId();
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was a database error when inserting a new book.");
  }
}

// get monthly tasks
function get_tasks_monthly() {
  global $db;

  try {
    $query = "SELECT * From tasks WHERE User_idd = ? AND MONTH(Date_Created) = MONTH(NOW())";
    $stmt = $db->prepare($query);
    $stmt->execute([$_SESSION["userName"]]);
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting existing books.");
  }
}

// Get weekly tasks
function get_tasks_weekly() {
  global $db;

  try {
    $query = "SELECT * From tasks WHERE User_idd = ? AND YEARWEEK(Date_Created) = YEARWEEK(NOW())";
    $stmt = $db->prepare($query);
    $stmt->execute([$_SESSION["userName"]]);
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting existing books.");
  }
}

// get daily tasks
function get_tasks() {
  global $db;

  try {
    $query = "SELECT * From tasks WHERE User_idd = ? AND DAY(Date_Created) = DAY(NOW())";
    $stmt = $db->prepare($query);
    $stmt->execute([$_SESSION["userName"]]);
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting existing books.");
  }
}

// get all tasks for admin
function get_tasks_all() {
  global $db;

  try {
    $query = "SELECT * From tasks";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting existing books.");
  }
}

// get individual task
function get_task($id) {
  global $db;

  try {
    $query = "SELECT * FROM tasks WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    return  $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting existing books.");
  }
}

// update task
function update_task($task, $task_title, $id) {
  global $db;
  try {
    $query = "UPDATE tasks SET task = ?, Task_Title = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$task, $task_title, $id]);
    return $db->lastInsertId();
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error ");
  }
}

// Insert Note
function insert_note($note, $title, $summary, $class) {
  global $db;

  try {
    $query = "INSERT INTO notes(File_Location, User_idd, Note_Name, Summary, class) VALUES (?,?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([$note, $_SESSION["userName"], $title, $summary, $class]);
    return $db->lastInsertId();
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was a database error when inserting a new book.");
  }
}

//Get a note by user ID
function get_note($id) {
  global $db;

  try {
    $query = "SELECT * FROM notes WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    return  $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting existing books.");
  }
}
// Update note
function update_note($noteName, $summary, $class, $id) {
  global $db;
  try {
    $query = "UPDATE notes SET Note_Name = ?, Summary = ?, class = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$noteName, $summary,$class, $id]);
    return $db->lastInsertId();
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error ");
  }
}

// delete note
function delete_note($id) {
  global $db;

  try {
    $query = "DELETE FROM notes WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    return $db->lastInsertId();
  } catch (PDOException $e) {
      db_disconnect();
      exit("Aborting: There was a database error when inserting a new book.");
  }
}



// get user notes
function get_notes() {
  global $db;

  try {
    $query = "SELECT * From notes WHERE User_idd = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$_SESSION["userName"]]);
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting existing books.");
  }
}

// get all notes for admin
function get_all_notes() {
  global $db;

  try {
    $query = "SELECT * From notes";
    $stmt = $db->prepare($query);
    $stmt->execute();
    return  $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting existing books.");
  }
}


# Returns TRUE if given user and password are created in database.
# (If username doesn't already exist and password is valid)
function register($firstName, $lastName, $email, $school, $userName, $password) {
  global $db;
  $salt = rand(1, 15);
  $salt = sha1($salt);
  $registered = FALSE;
  try {
    $sql = "INSERT INTO users(FirstName, LastName,Email, Password, School, UserName, Salt, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = $db->prepare($sql);
    $params = [ $firstName, $lastName, $email, crypt($password, $salt), $school, $userName, $salt, "student" ];
    $statement->execute($params);
    $registered = TRUE;
  } catch (PDOException $e) {
    echo "ERROR";
    var_dump($e);
  }
  return $registered;
}

# Returns TRUE if given password is correct password for this user name.
function is_password_correct($name, $password) {
  global $db;
  $password_correct = FALSE;
  
  $sql = "SELECT Password, Salt FROM users WHERE username = ?";
  $statement = $db->prepare($sql);
  $statement->execute([$name]);
  
  if ($statement) {
    foreach ($statement as $row) {
      $correct_password = $row["Password"];
      $salt = $row["Salt"];
      $password = crypt($password, $salt);
      $password_correct = $correct_password === $password;
    }
  }
  return $password_correct;
}



// get user logged in.
function get_user($id) {
  global $db;

  try {
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    return  $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
  } catch (PDOException $e) {
    db_disconnect();
    exit("Aborting: There was a database error when getting existing books.");
  }
}
