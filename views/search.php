<?php

$title = "Search";
ob_start();
require "nav.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Search</title>
</head>

<body>

<p><a href="../">Go home</a></p>
<h1><?php echo $title ?></h1>


    <form action="" method="post">
      <input type="text" name="search_term" placeholder="Search...">
      <input type="submit" name="search" value="Search">
    </form>
    <?php
      if (isset($data)) {
        foreach ($data as $row) {
          echo $row['title'] . "<br>";
        }
      }
    ?>


<?php
require_once "../model/model.php";
?>

</body>