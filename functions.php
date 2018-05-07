<<?php

//Setup connection with MySQL
function connect($host, $dbName, $user, $userPass)
{
  try
  {
      $conn = new PDO("mysql:host=" . $host .  ";dbname=" . $dbName, $user, $userPass);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
      return $conn;

  }

  catch(PDOException $e)
  {
      echo "Connection failed: " . $e->getMessage();
  }

}

//Function to send data into database
function sendTask($connection, $title, $description, $dueDate, $priority, $completedDate)
{
  //Use this for all time variables except due_date
  $creation_time = date('Y-m-d');

  $sql = "INSERT INTO tasks(title, description, creation_time, due_date, last_update, priority, completed_date)
  VALUES ('{$title}', '{$description}', '{$creation_time}', '{$dueDate}', '{$creation_time}' , '{$priority}', '{$completedDate}');";
  echo $sql;
  try
  {
    //$connection->exec($sql);
    $stmt = $connection->prepare($sql);
    $stmt->execute();
  }

  catch (PDOException $e)
  {
    echo $e->getMessage();
  }


}

//Get all tasks and return as an array
function getTasks($connection, $order)
{
  $sql = "SELECT * FROM tasks ORDER BY " . $order;
  try
  {
    $stmt = $connection->prepare($sql);
    $stmt-> execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }

  catch (PDOException $e)
  {
    echo $e;
  }
}

//Deletes task from database
function deleteTask($connection, $task)
{
    try
    {
      echo $task;
      $sql = "DELETE FROM tasks WHERE title = " . "'" .  $task . "'";
      echo $sql;
      $stmt = $connection->prepare($sql);
      $stmt->execute();
    }

    catch (PDOException $e)
    {
      echo $e;
    }
}

//Returns task to edit
function returnTask($connection, $task)
{
  echo $task . "</br>";
  $sql = "SELECT * FROM tasks WHERE title = " . "'" . $task . "'";

  try
  {
    $stmt = $connection->prepare($sql);
    $stmt-> execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    print_r($result);
    return $result;

  }

  catch (PDOException $e)
  {
    echo $e;
  }
}

function editTask($connection, $oldTitle,  $title, $description, $dueDate, $priority, $completedDate)
{
  //Use this for all time variables except due_date
  $last_updated = date('Y-m-d');

  $sql = "INSERT INTO tasks(title, description,  due_date, last_update, priority, completed_date)
  VALUES ('{$title}', '{$description}', '{$dueDate}', '{$last_updated}' , '{$priority}', '{$completedDate}') WHERE title = " . "'" .  $oldTitle . "' ;" ;

  try
  {
    //$connection->exec($sql);
    $stmt = $connection->prepare($sql);
    $stmt->execute();
  }

  catch (PDOException $e)
  {
    echo $e->getMessage();
  }


}
 ?>
