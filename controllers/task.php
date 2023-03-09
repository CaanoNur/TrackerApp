<?php
require_once "../model/model.php";
require "common.php";

$projects = get_all_projects();
$tasks = get_all_tasks();

if (isset($_GET['id'])) {
    list($id, $task_title, $date, $time) = get_task($_GET['id']);
} else {
    $task_title = "";
    $date = "";
    $time = "";
}


if (isset($_POST['submit'])) {
    $id = null;
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    $project_id = escape(trim($_POST['project_id']));
    $task_title = escape($_POST['title']);
    $date = escape($_POST['date']);
    $time = escape($_POST['time']);


    if (empty($project_id) || empty($task_title) || empty($date) || empty($time)) {
            $error_message = "Project, title, date or time is empty";
        } else {
            if (titleExists("tasks", $task_title) && $id == null ) {
                $error_message = "I'm sorry but it looks like  \"" . $task_title ."\" already exists";
        } else {
        if (add_tasks($project_id, $task_title, $date, $time, $id)) {
        header('Refresh:4; url=task_list.php');
        if (!empty($id)) {
            $confirm_message = escape($task_title) . ' updated successfully';
        } else {
            $confirm_message = escape($task_title) . ' added successfully';
        }
    } else {
        $error_message = "There is something wrong";
    }
    }
}
}


require "../views/task.php";