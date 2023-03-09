<?php
require "common.php";
$title = 'Tasks list';

ob_start();
require 'nav.php';
?>

<div class="container">
    <p><a href="../">Go Home</a></p>

    <h1><?php echo $title . " (" . $taskCount . ")" ?></h1>
    <!-- If theres not yet data -->
    <?php if ($taskCount == 0) { ?>
        <div>
            <p> You have not yet added any tasks </p>
            <p><a href="../controllers/task_list.php">Add Tasks</a></p>
        </div>
        <?php  } ?>

        <ul>
            <?php foreach ($tasks as $task) : ?>
                <li>
                    <a href="../controllers/task.php?id=<?php echo $task['id']; ?>">
                     <?php echo escape($task["title"]) ?>
                </a>
               <?php
        echo " (Date: " . $task["ttime"] . ", Project: " . $task["project"] . ")"; 
                ?>
                <form method="post">
                <input type="hidden" value="<?php echo $task["id"]; ?>" name="delete">
                <input type="submit" value="delete">
                </form>
            </li>
                <?php endforeach; ?>
        </ul>
</div>


<?php
$content = ob_get_clean();
include 'layout.php'
?>


