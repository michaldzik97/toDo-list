<?php
require_once "config.php";
require_once "functions.php";

//Create connection and return PDO object
$conn = connect( DB_HOST, DB_NAME, DB_USER, DB_PASS);

//Variables to hold edit values
$task = NULL;
$description = NULL;
$due_date = NULL;
$completed_date = NULL;
$priority_def = '5';

$edit = false;

if(!isset($_GET['order']))
{
  $order = "due_date";
}
else
{
  $order = $_GET['order'];
}

if(isset($_POST['submit']))
{
  if (empty($_POST['task']))
  {
    echo "Fill in task!";
  }
  elseif (empty($_POST['description']))
  {
    echo "Fill in description";
  }
  elseif (empty($_POST["due_date"]))
  {
    echo "Select Date!";
  }
  elseif (empty($_POST["completed_date"]))
  {
    echo "Select approximate completion date!";
  }
  else
  {
      sendTask($conn, $_POST['task'], $_POST['description'], $_POST["due_date"], $_POST["priority"], $_POST["completed_date"]);
      header("Location: todo-list.php"); // redirect to the base page to clear the form data
      $conn = NULL;
      exit;
  }
}

if (isset($_POST['edit']))
{
  $task_array = returnTask($conn, $_GET['edit_task']);
  //To hold currently edited task (wanted to use id but database refused to cooperate)
  $old_task = $task_array[0]['title'];
  $task = $old_task;
  // editTask($conn, $old_task,  $_POST['task'], $_POST['description'], $_POST["due_date"], $_POST["priority"], $_POST["completed_date"]);
}

if(isset($_GET['del_task']) )
{
  deleteTask($conn, $_GET['del_task']);
  header("Location: todo-list.php"); // redirect to the base page to clear the form data
  $conn = NULL;
  exit;
}

if(isset($_GET['edit_task']))
{
  $edit = true;
  $task_array = returnTask($conn, $_GET['edit_task']);
  $wtf =  $task_array;
  $task =  $task_array[0]['title'];
  $description = $task_array[0]['description'];
  $due_date = $task_array[0]['due_date'];
  $completed_date = $task_array[0]['completed_date'];
  $priority_def = $task_array[0]['priority'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>ToDo List Application PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="dateManager.js"></script>
</head>
<body>
	<div class="heading">
		<h2 style="font-style: 'Hervetica';">ToDo List using PHP and MySQL database with XAMPP</h2>
	</div>
	<form method="post" action="todo-list.php" class="input_form">
    <div>
      <label> Task </label>
		  <input type="text" name="task" class="task_input" value="<?php echo $task; ?>">
    </div>
    <div>
      <label> Description </label>
      <input type="text" name = "description" class = "task_input" value="<?php echo $description; ?>">
    </div>
    <div>
      <label> Due date </label>
      <input type="date" id="dt" name = "due_date" class = "task_input" onchange = "mydate1('due_date', 'due_date2');" value="<?php echo $due_date; ?>"/>
      <input type="text" id="ndt" name ="due_date2" onclick="mydate('dt', 'ndt');" hidden />
    </div>
    <div>
      <label> Completion date </label>
      <input type="date" id="c_dt" name = "completed_date" class = "task_input" onchange = "mydate1('completed_date', 'completed_date2');" value="<?php echo $completed_date; ?>"/>
      <input type="text" id="c_ndt" name ="completed_date2" onclick="mydate('completed_date', 'completed_date2');" hidden />
    </div>
    <div class="slidecontainer">
      <label> Priority </label>
      <input type="range" min="1" max="10" value="<?php echo $priority_def; ?>" class="slider" id="myRange" name = 'priority'>
    </div>
    <!-- Default button state -->
    <?php if (!$edit): ?>
      <button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
    <!-- On edit -->
    <?php else: ?>
		  <button type="submit" name="edit" id="edit_btn" class="add_btn">Submit</button>
    <?php endif?>
	</form>
  <table cellspacing = "60">
	<thead>
		<tr>
      <th> N </th>
			<th> Task </th>
      <th> Description </th>
      <th> <a class = "delete" href="todo-list.php?order=<?php echo 'creation_time'?>"> </a> Created </th>
      <th> <a class = "delete" href="todo-list.php?order=<?php echo 'due_date'?>"> </a> Due date </th>
      <th> <a class = "delete" href="todo-list.php?order=<?php echo 'priority'?>"> </a> Priority  </th>
      <th> Completion date </th>
      <th> Last updated</th>
			<th> Action</th>
		</tr>
	</thead>

	<tbody>
		<!-- //Get all tasks -->
	     <?php
        $results = getTasks($conn, $order);
        foreach ($results as $key => $value)
        {
          //Print one row from table at time
        ?>
        <tr>
              <td nowrap> <?php echo $key + 1; ?> </td>
				      <td nowrap> <?php echo $results[$key]['title']; ?></td>
				      <td nowrap> <?php echo $results[$key]['description']; ?></td>
              <td nowrap> <?php echo $results[$key]['creation_time']; ?></td>
              <td nowrap> <?php echo $results[$key]['due_date']; ?></td>
              <td nowrap> <?php echo $results[$key]['priority']; ?></td>
              <td nowrap> <?php echo $results[$key]['completed_date']; ?></td>
              <td nowrap> <?php echo $results[$key]['last_update']; ?></td>
              <td class="delete">
                <a href="todo-list.php?del_task=<?php echo $results[$key]['title']?>"> Done </a>
              </td>
              <td class="delete">
                <a href="todo-list.php?edit_task=<?php echo $results[$key]['title']?>"> Edit </a>
              </td>
        </tr>
      <?php
    }
    ?>

	</tbody>
</table>
</body>
</html>


<?php



?>
