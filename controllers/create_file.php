<?php
require_once "../model/model.php";

$projects = get_all_projects();
$tasks = get_all_tasks();



header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="test.csv"');
$data = array(
        'Project_ID;Project_Title;Category;Task_Title;Task_id',
        'kkk'
        
);

<?php foreach ($tasks as $task) : ?>

<?php echo "Normal: ",  json_encode($task) ?>

<?php endforeach; ?>

    
<?php 

$fp = fopen('php://output', 'wb');
foreach ( $data as $line ) {
    $val = explode(",", $line);
    fputcsv($fp, $val);
}
fclose($fp);

