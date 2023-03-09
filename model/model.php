<?php
// model/model.php
require "connection.php";

$connection = db_connect();

function get_all_projects()
{
    try{
        global $connection;

        $sql = 'SELECT * FROM projects ORDER BY title';
        $projects = $connection ->query($sql);

        return $projects;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err-getMessage();
        exit;
    }
}

function get_all_projects_count()
{
    try{
        global $connection;

        $sql = 'SELECT COUNT(id) AS nb FROM projects';
        $statement = $connection->query($sql)->fetch();

        $projectCount = $statement['nb'];

        return $projectCount;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err-getMessage();
        exit; 
    }
}

function get_all_tasks()
{
    try{
        global $connection;

        $sql = 'SELECT t.*, DATE_FORMAT(t.date_task, "%d.%m.%y") as ttime, p.title project
        FROM tasks t
        INNER JOIN projects p ON t.project_id = p.id
        ORDER BY t.date_task ASC';
        $tasks = $connection ->query($sql);
        return $tasks;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err-getMessage();
        exit;
    }
}

function get_all_tasks_count()
{
    try{
        global $connection;

        $sql = 'SELECT COUNT(id) AS nb FROM tasks';
        $statement = $connection->query($sql)->fetch();

        $taskCount = $statement['nb'];

        return $taskCount;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err-getMessage();
        exit; 
    }
}

// --- ADD Project ---
function add_project($title, $category, $id)
{
    try {
        global $connection;

        if ($id) {
            $sql = 'UPDATE projects SET title = ?, category = ? WHERE id =?';
        }   else {
            $sql = 'INSERT INTO projects(title, category) VALUES(?, ?)';
        }
        $statement = $connection->prepare($sql);
        $new_project = array($title, $category);

        if ($id) {
            $new_project = array($title, $category, $id);
        }

        $affectedLines = $statement->execute($new_project);

        return $affectedLines;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function titleExists($table, $title)
{    
    try{
        global $connection;

        $sql = 'Select title FROM ' . $table . ' WHERE title = ?';
        $statement = $connection->prepare($sql);
        $statement -> execute(array($title));

        if ($statement->rowCount() > 0) {
            return true;
        }
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit; 
    }
}

function add_tasks($project_id, $task_title, $date, $time, $id)
{
    try{
        global $connection;
        
        if ($id) {
            $sql = 'UPDATE tasks SET project_id = ?, title = ?, date_task = ?, time_task = ? WHERE id =?';
        }   else {
        $sql = 'INSERT INTO tasks(project_id , title, date_task, time_task) VALUES(?, ?, ?, ?)';
        }
        $statement = $connection->prepare($sql);
        $new_task = array($project_id, $task_title, $date, $time);

        if ($id) {
            $new_task = array($project_id, $task_title, $date, $time, $id);
        }

        $affectedLines = $statement->execute($new_task);

        return $affectedLines;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit; 
    }
}


function get_project($id)
{
    try {
        global $connection;

        $sql = 'SELECT * FROM projects WHERE id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1, $id, PDO::PARAM_INT);
        $project->execute();

        return $project->fetch();
    }   catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function get_task($id)
{
    try {
        global $connection;

        $sql = 'SELECT * FROM tasks WHERE id = ?';
        $tasks = $connection->prepare($sql);
        $tasks->bindValue(1, $id, PDO::PARAM_INT);
        $tasks->execute();

        return $tasks->fetch();
    }   catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function delete_task($id)
{
    try {
        global $connection;
        $sql = 'DELETE FROM tasks WHERE id = ?';
        $task = $connection->prepare($sql);
        $task->bindValue(1, $id, PDO::PARAM_INT);
        $task->execute();

        return true;
    }   catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function delete_project($id)
{
    try {
        global $connection;
        $sql = 'DELETE FROM projects WHERE id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1, $id, PDO::PARAM_INT);
        $project->execute();

        return true;
    }   catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function search_projects($query)
{
    {
    $conn = mysqli_connect("mariadb.vamk.fi", "e2101714", "9BgyKCSUWAS", "e2101714_proman");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_close($conn);

    return $data;
  }
}
